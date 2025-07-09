const CACHE_NAME = "gkinoo-cache-v1";
const toCache = [
  "/",
  "/index.html",
  "/icon.png",
  "/logo.png",
  "/manifest.webmanifest"
  // Diğer statik dosyalarınızı ekleyebilirsiniz
];

self.addEventListener("install", event => {
  event.waitUntil(
    caches.open(CACHE_NAME).then(cache => cache.addAll(toCache))
  );
});

self.addEventListener("activate", event => {
  event.waitUntil(
    caches.keys().then(keys =>
      Promise.all(
        keys.filter(key => key !== CACHE_NAME).map(key => caches.delete(key))
      )
    )
  );
});

self.addEventListener("fetch", event => {
  event.respondWith(
    caches.match(event.request).then(response =>
      response || fetch(event.request)
    )
  );
});
