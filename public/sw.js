self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open('stu-key-cache-v1').then((cache) => {
      return cache.addAll([
        '/',
        '/offline',
        '/manifest.json',
        '/favicon.ico',
      ]);
    })
  );
  self.skipWaiting();
});

self.addEventListener('fetch', (event) => {
  event.respondWith(
    fetch(event.request).catch(() => caches.match(event.request).then((response) => response || caches.match('/offline')))
  );
});
