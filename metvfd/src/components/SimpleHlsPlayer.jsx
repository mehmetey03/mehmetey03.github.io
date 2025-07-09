import { useEffect, useRef, useState } from 'react';
import Hls from 'hls.js';

const LANG_MAP = {
  tr: 'Türkçe', en: 'İngilizce', de: 'Almanca', fr: 'Fransızca',
  es: 'İspanyolca', it: 'İtalyanca', ar: 'Arapça', ru: 'Rusça',
  ja: 'Japonca', ko: 'Korece', fa: 'Farsça', zh: 'Çince',
};

function formatTime(seconds) {
  if (isNaN(seconds)) return '00:00:00';
  const h = Math.floor(seconds / 3600);
  const m = Math.floor((seconds % 3600) / 60);
  const s = Math.floor(seconds % 60).toString().padStart(2, '0');
  return `${h.toString().padStart(2, '0')}:${m.toString().padStart(2, '0')}:${s}`;
}

export default function AdvancedHlsPlayer({ url }) {
  const videoRef = useRef(null);
  const hlsRef = useRef(null);
  const buttonStates = useRef({});

  const [currentTime, setCurrentTime] = useState(0);
  const [duration, setDuration] = useState(0);
  const [progress, setProgress] = useState(0);
  const [volume, setVolume] = useState(1);
  const [playbackRate, setPlaybackRate] = useState(1);
  const [isFit, setIsFit] = useState('contain');

  const [selectedAudio, setSelectedAudio] = useState(0);
  const [selectedSubtitle, setSelectedSubtitle] = useState(-1);
  const [audioTracks, setAudioTracks] = useState([]);
  const [subtitleTracks, setSubtitleTracks] = useState([]);
  const [qualityLevels, setQualityLevels] = useState([]);

  const [showSpeedOptions, setShowSpeedOptions] = useState(false);
  const [showLangOptions, setShowLangOptions] = useState(false);
  const [showSubtitleOptions, setShowSubtitleOptions] = useState(false);
  const [showQualityOptions, setShowQualityOptions] = useState(false);

  const [notification, setNotification] = useState('');
  const [notificationVisible, setNotificationVisible] = useState(false);
  const [controlsVisible, setControlsVisible] = useState(true);
  const [progressBarVisible, setProgressBarVisible] = useState(true);
  const [notificationTimer, setNotificationTimer] = useState(null);

  const enterFullscreen = () => {
    const container = document.getElementById('player-container');
    if (container?.requestFullscreen) {
      container.requestFullscreen().catch(err => {
        console.warn('Tam ekran başarısız:', err);
      });
    }
  };

  useEffect(() => {
    const video = videoRef.current;
    if (!video) return;

    enterFullscreen();
    video.tabIndex = 0;
    video.focus();

    const hls = new Hls();
    hlsRef.current = hls;
    hls.loadSource(url);
    hls.attachMedia(video);

    hls.on(Hls.Events.AUDIO_TRACKS_UPDATED, (_, data) => {
      setAudioTracks(data.audioTracks);
      const lang = navigator.language.split('-')[0];
      const idx = data.audioTracks.findIndex(t => t.lang === lang);
      if (idx >= 0) {
        hls.audioTrack = idx;
        setSelectedAudio(idx);
      }
    });

    hls.on(Hls.Events.SUBTITLE_TRACKS_UPDATED, (_, data) => {
      setSubtitleTracks(data.subtitleTracks);
      hls.subtitleTrack = -1;
      setSelectedSubtitle(-1);
      const tracks = video.textTracks;
      for (let i = 0; i < tracks.length; i++) {
        tracks[i].mode = 'disabled';
      }
    });

    hls.on(Hls.Events.LEVELS_UPDATED, (_, data) => {
      setQualityLevels(data.levels);
    });

    const updateTime = () => {
      setCurrentTime(video.currentTime);
      setDuration(video.duration || 0);
      setProgress((video.currentTime / video.duration) * 100 || 0);
    };

    video.addEventListener('timeupdate', updateTime);
    return () => video.removeEventListener('timeupdate', updateTime);
  }, [url]);

  useEffect(() => {
    window.addEventListener('click', enterFullscreen);
    window.addEventListener('touchstart', enterFullscreen);
    return () => {
      window.removeEventListener('click', enterFullscreen);
      window.removeEventListener('touchstart', enterFullscreen);
    };
  }, []);

  useEffect(() => {
    const handleKeyPress = (e) => {
      const video = videoRef.current;
      if (!video) return;

      switch (e.key) {
        case 'ArrowUp':
          video.volume = Math.min(1, video.volume + 0.1);
          setVolume(video.volume);
          showNotification(`Ses %${Math.round(video.volume * 100)}`);
          break;
        case 'ArrowDown':
          video.volume = Math.max(0, video.volume - 0.1);
          setVolume(video.volume);
          showNotification(`Ses %${Math.round(video.volume * 100)}`);
          break;
        case 'ArrowRight':
          video.currentTime += 15;
          showNotification('⏩ 15 saniye ileri');
          break;
        case 'ArrowLeft':
          video.currentTime -= 15;
          showNotification('⏪ 15 saniye geri');
          break;
        case ' ':
        case 'Enter':
          video.paused ? video.play() : video.pause();
          showNotification(video.paused ? '⏸️ Duraklat' : '▶️ Oynat');
          break;
        case 't':
          toggleFit();
          break;
      }
    };
    window.addEventListener('keydown', handleKeyPress);
    return () => window.removeEventListener('keydown', handleKeyPress);
  }, []);

  useEffect(() => {
    let frame;
    const pollGamepad = () => {
      const gp = navigator.getGamepads?.()[0];
      if (gp) {
        const pressed = (i) => gp.buttons[i]?.pressed;

        if (pressed(0) && !buttonStates.current[0]) {
          const video = videoRef.current;
          video.paused ? video.play() : video.pause();
          showNotification(video.paused ? '⏸️ Duraklat' : '▶️ Oynat');
          buttonStates.current[0] = true;
        } else if (!pressed(0)) buttonStates.current[0] = false;

        if (pressed(1) && !buttonStates.current[1]) {
          toggleFit();
          buttonStates.current[1] = true;
        } else if (!pressed(1)) buttonStates.current[1] = false;

        if (pressed(15) && !buttonStates.current[15]) {
          videoRef.current.currentTime += 10;
          showNotification('⏩ Gamepad sağ');
          buttonStates.current[15] = true;
        } else if (!pressed(15)) buttonStates.current[15] = false;

        if (pressed(14) && !buttonStates.current[14]) {
          videoRef.current.currentTime -= 10;
          showNotification('⏪ Gamepad sol');
          buttonStates.current[14] = true;
        } else if (!pressed(14)) buttonStates.current[14] = false;
      }
      frame = requestAnimationFrame(pollGamepad);
    };
    frame = requestAnimationFrame(pollGamepad);
    return () => cancelAnimationFrame(frame);
  }, []);

  const toggleFit = () => {
    setIsFit(prev => {
      const next = prev === 'contain' ? 'cover' : 'contain';
      showNotification(next === 'contain' ? 'Fit: Sığdır' : 'Fit: Doldur');
      return next;
    });
  };

  const showNotification = (msg) => {
    setNotification(msg);
    setNotificationVisible(true);
    setTimeout(() => setNotificationVisible(false), 2000);
  };

  const showControls = () => {
    setControlsVisible(true);
    setProgressBarVisible(true);
    clearTimeout(notificationTimer);
    setNotificationTimer(setTimeout(() => {
      setControlsVisible(false);
      setProgressBarVisible(false);
    }, 3000));
  };

  useEffect(() => {
    const onMouseMove = () => showControls();
    const onTouchStart = () => showControls();
    window.addEventListener('mousemove', onMouseMove);
    window.addEventListener('touchstart', onTouchStart);
    return () => {
      window.removeEventListener('mousemove', onMouseMove);
      window.removeEventListener('touchstart', onTouchStart);
    };
  }, [notificationTimer]);
  const seekTo = (e) => {
    const rect = e.currentTarget.getBoundingClientRect();
    const ratio = (e.clientX - rect.left) / rect.width;
    const newTime = ratio * duration;
    if (!isNaN(newTime) && videoRef.current) {
      videoRef.current.currentTime = newTime;
    }
  };

  const handleVolumeToggle = () => {
    const newVolume = volume === 0 ? 1 : 0;
    setVolume(newVolume);
    if (videoRef.current) videoRef.current.volume = newVolume;
    showNotification(newVolume === 0 ? '🔇 Ses Kapalı' : `🔊 Ses %${Math.round(newVolume * 100)}`);
  };

  const handleQualityChange = (e) => {
    const level = parseInt(e.target.value, 10);
    if (hlsRef.current) {
      if (level === -1) {
        hlsRef.current.autoLevelEnabled = true;
      } else {
        hlsRef.current.autoLevelEnabled = false;
        hlsRef.current.currentLevel = level;
      }
    }
  };

  const buttonStyle = {
    background: 'rgba(0, 0, 0, 0.5)',
    border: 'none',
    borderRadius: '50%',
    padding: '10px',
    cursor: 'pointer',
  };

  const selectStyle = {
    backgroundColor: 'rgba(0, 0, 0, 0.5)',
    color: '#fff',
    border: 'none',
    borderRadius: '50px',
    padding: '6px 10px',
    cursor: 'pointer',
  };

  return (
    <div id="player-container" style={{
      position: 'fixed',
      inset: 0,
      background: '#000',
      zIndex: 999
    }}>
      <video
        ref={videoRef}
        tabIndex="0"
        autoPlay
        controls={false}
        style={{
          width: '100%',
          height: '100%',
          objectFit: isFit,
          backgroundColor: 'transparent',
          outline: 'none',
          willChange: 'transform'
        }}
      />
      <style>{`
        video::cue {
          background: rgba(0, 0, 0, 0.35);
          color: white;
          font-size: clamp(22px, 3vw, 36px); /* ✅ Büyütülmüş ve responsive altyazı */
          text-shadow: 1px 1px 3px black;
          line-height: 1.5;
          font-family: 'Segoe UI', sans-serif;
        }
        video:focus {
          outline: none;
        }
      `}</style>

      {/* Bildirim */}
      {notificationVisible && (
        <div style={{
          position: 'absolute',
          top: '20px',
          left: '50%',
          transform: 'translateX(-50%)',
          background: 'rgba(0,0,0,0.7)',
          color: '#fff',
          padding: '8px 16px',
          borderRadius: '6px',
          zIndex: 1000,
        }}>
          {notification}
        </div>
      )}

      {/* Süre ve progress bar */}
      {progressBarVisible && (
        <>
          <div style={{
            position: 'absolute',
            bottom: '100px',
            left: '12px',
            color: '#fff',
            fontSize: '14px',
            background: 'rgba(0,0,0,0.6)',
            padding: '4px 8px',
            borderRadius: '4px',
            zIndex: 100,
          }}>
            {formatTime(currentTime)} / {formatTime(duration)}
          </div>
          <div onClick={seekTo} style={{
            position: 'absolute',
            bottom: '90px',
            left: 0,
            width: '100%',
            height: '6px',
            background: '#111',
            cursor: 'pointer',
            zIndex: 99,
          }}>
            <div style={{
              width: `${progress}%`,
              height: '100%',
              background: 'linear-gradient(to right,rgb(229, 9, 20),rgb(184, 29, 36))',
              transition: 'width 0.2s ease',
            }} />
          </div>
        </>
      )}

      {/* Kontrol Paneli */}
      <div style={{
        position: 'absolute',
        bottom: '20px',
        right: '12px',
        display: 'flex',
        gap: 12,
        alignItems: 'center',
        zIndex: 100,
        opacity: controlsVisible ? 1 : 0,
        transition: 'opacity 0.5s ease',
        pointerEvents: controlsVisible ? 'auto' : 'none',
      }}>
        <button onClick={handleVolumeToggle} style={buttonStyle}>
          <span className="material-icons" style={{ color: '#fff' }}>
            {volume === 0 ? 'volume_off' : 'volume_up'}
          </span>
        </button>

        <button onClick={() => setShowSpeedOptions(!showSpeedOptions)} style={buttonStyle}>
          <span className="material-icons" style={{ color: '#fff' }}>speed</span>
        </button>
        {showSpeedOptions && (
          <select value={playbackRate} onChange={(e) => {
            const rate = parseFloat(e.target.value);
            setPlaybackRate(rate);
            if (videoRef.current) videoRef.current.playbackRate = rate;
          }} style={selectStyle}>
            <option value={0.25}>0.25x</option>
            <option value={0.50}>0.5x</option>
            <option value={0.75}>0.75x</option>
            <option value={1}>1x</option>
            <option value={1.25}>1.25x</option>
            <option value={1.5}>1.5x</option>
            <option value={2}>2x</option>
          </select>
        )}

        <button onClick={() => setShowLangOptions(!showLangOptions)} style={buttonStyle}>
          <span className="material-icons" style={{ color: '#fff' }}>language</span>
        </button>
        {showLangOptions && (
          <select value={selectedAudio} onChange={(e) => {
            const idx = parseInt(e.target.value, 10);
            setSelectedAudio(idx);
            if (hlsRef.current) hlsRef.current.audioTrack = idx;
          }} style={selectStyle}>
            {audioTracks.map((track, idx) => (
              <option key={idx} value={idx}>
                {LANG_MAP[track.lang] || `Dil ${idx + 1}`}
              </option>
            ))}
          </select>
        )}

        <button onClick={() => setShowSubtitleOptions(!showSubtitleOptions)} style={buttonStyle}>
          <span className="material-icons" style={{ color: '#fff' }}>subtitles</span>
        </button>
        {showSubtitleOptions && (
          <select value={selectedSubtitle} onChange={(e) => {
            const idx = parseInt(e.target.value, 10);
            setSelectedSubtitle(idx);
            if (hlsRef.current) hlsRef.current.subtitleTrack = idx;
            const tracks = videoRef.current?.textTracks;
            if (tracks && tracks[idx]) tracks[idx].mode = 'showing';
          }} style={selectStyle}>
            <option value={-1}>Altyazı Yok</option>
            {subtitleTracks.map((track, idx) => (
              <option key={idx} value={idx}>
                {LANG_MAP[track.lang] || `Dil ${idx + 1}`}
              </option>
            ))}
          </select>
        )}

        <button onClick={() => setShowQualityOptions(!showQualityOptions)} style={buttonStyle}>
          <span className="material-icons" style={{ color: '#fff' }}>hd</span>
        </button>
        {showQualityOptions && (
          <select onChange={handleQualityChange} style={selectStyle}>
            <option value={-1}>Otomatik</option>
            {qualityLevels.map((level, idx) => (
              <option key={idx} value={idx}>
                {level.height}p
              </option>
            ))}
          </select>
        )}

        <button onClick={toggleFit} style={buttonStyle}>
          <span className="material-icons" style={{ color: '#fff' }}>fit_screen</span>
        </button>
      </div>
    </div>
  );
}