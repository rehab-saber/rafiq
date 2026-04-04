<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Rafiq</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background: #ffffff;
      color: #333;
    }

    .container {
      height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      padding: 20px;
    }

    .card {
      text-align: center;
      padding: 40px;
      border-radius: 16px;
      max-width: 500px;
      background: #ffffff;
      box-shadow: 0 8px 25px rgba(0,0,0,0.1);
      border-top: 6px solid #1565C0;
    }

    .logo {
      width: 100px;
      height: 100px;
      margin: 0 auto 20px;
      border-radius: 50%;
      background: #f0f4ff;
      display: flex;
      align-items: center;
      justify-content: center;
      color: #1565C0;
      font-weight: bold;
      font-size: 18px;
      overflow: hidden;
      border: 3px solid #42A5F5;
    }

    .logo img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    h1 {
      margin: 10px 0;
      font-size: 32px;
      color: #1565C0;
    }

    p {
      font-size: 16px;
      line-height: 1.6;
      margin-top: 10px;
    }

    .highlight {
      color: #E65100;
      font-weight: bold;
    }

    .tag {
      margin-top: 20px;
      display: inline-block;
      padding: 8px 16px;
      border-radius: 20px;
      background: linear-gradient(135deg, #E65100, #FF8F00);
      color: white;
      font-size: 14px;
    }
  </style>
</head>

<body>

  <div class="container">
    <div class="card">

      <!-- LOGO PLACE -->
      <div class="logo">
        
        <img src="{{ asset('images/logo.png') }}" alt="Rafiq Logo"> 
        
      </div>

      <h1>Welcome to <span class="highlight">Rafiq</span></h1>

      <p>
        A Mobile Application for Supporting Children with Autism Spectrum Disorder.
      </p>

      <p>
        Rafiq helps children learn, interact, and develop essential skills through
        structured activities designed with care, simplicity, and accessibility in mind.
      </p>

      <div class="tag">For a Better Learning Experience</div>

    </div>
  </div>

</body>
</html>