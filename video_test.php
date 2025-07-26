<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Video Test</title>
  <style>
    body {
      margin: 0;
      padding: 0;
    }
    .video-background {
      position: fixed;
      right: 0;
      bottom: 0;
      min-width: 100%;
      min-height: 100%;
      z-index: -1;
      object-fit: cover;
    }
  </style>
</head>
<body>
<video autoplay muted loop style="width: 100%; height: auto;">
  <source src="videos/college_bg.mp4" type="video/mp4">
  Your browser does not support the video tag.
</video>
  <h1 style="color: white; position: relative; z-index: 1; text-align: center; margin-top: 50vh;">
    Video Background Test
  </h1>
</body>
</html>
