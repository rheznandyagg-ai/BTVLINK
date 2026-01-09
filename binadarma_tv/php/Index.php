<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pendaftaran Bina Darma TV</title>

    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: Arial, sans-serif;
            background: linear-gradient(135deg, #f0f8ff, #e6f3ff);
            color: #333;
        }
        header {
            background: linear-gradient(90deg, #007bff, #0056b3);
            color: white;
            padding: 15px 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .logo {
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .logo img { height: 45px; }
        nav ul { display: flex; list-style: none; }
        nav ul li { margin-left: 20px; }
        nav ul li a {
            color: white;
            text-decoration: none;
            padding: 8px 12px;
            border-radius: 5px;
        }
        nav ul li a:hover { background: rgba(255,255,255,0.2); }

        .hero {
            text-align: center;
            padding: 50px 20px;
            background: #fff;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .hero h1 { color: #ff8c00; font-size: 28px; }
        .hero p { font-size: 18px; margin-bottom: 20px; }
        .hero-image {
            width: 100%;
            max-width: 800px;
            height: 300px;
            object-fit: cover;
            border-radius: 10px;
        }

        .form-section {
            max-width: 600px;
            margin: 40px auto;
            padding: 30px;
            background: white;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
        }
        .form-section h2 {
            color: #007bff;
            text-align: center;
            margin-bottom: 20px;
        }
        input, select, button {
            width: 100%;
            padding: 12px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
        }
        button {
            background: linear-gradient(90deg, #28a745, #20c997);
            color: white;
            border: none;
            font-weight: bold;
            cursor: pointer;
        }
        footer {
            background: #007bff;
            color: white;
            text-align: center;
            padding: 20px;
            margin-top: 40px;
        }
    </style>
</head>
<body>

<header>
    <div class="logo">
        <img src="/binadarma_tv/assets/logo.png" alt="Logo Bina Darma TV">
        <strong>Bina Darma TV</strong>
    </div>
    <nav>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#daftar">Daftar</a></li>
        </ul>
    </nav>
</header>

<section class="hero" id="home">
    <h1>Sistem Pendaftaran Bina Darma TV</h1>
    <p>Daftar sebagai kontributor atau kru Bina Darma TV Universitas Bina Darma Palembang</p>
    <img src="/binadarma_tv/assets/fotobtv.jpg" class="hero-image">
</section>

<section class="form-section" id="daftar">
    <h2>Form Pendaftaran</h2>

    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {

        $nama = $_POST['nama'];
        $email = $_POST['email'];
        $nomor_hp = $_POST['nomor_hp'];
        $program = $_POST['program'];

        $conn = new mysqli("localhost", "root", "", "bdtv_db");
        if ($conn->connect_error) {
            die("<p style='color:red;text-align:center;'>Koneksi database gagal</p>");
        }

        $stmt = $conn->prepare(
            "INSERT INTO pendaftaran (nama, email, nomor_hp, program)
             VALUES (?, ?, ?, ?)"
        );
        $stmt->bind_param("ssss", $nama, $email, $nomor_hp, $program);

        if ($stmt->execute()) {
            echo "<p style='color:green;text-align:center;font-weight:bold;'>
                    ✅ Pendaftaran berhasil!
                  </p>";
        } else {
            echo "<p style='color:red;text-align:center;'>❌ Gagal menyimpan data</p>";
        }

        $stmt->close();
        $conn->close();
    }
    ?>

    <form method="POST">
        <input type="text" name="nama" placeholder="Nama Lengkap" required>
        <input type="email" name="email" placeholder="Email" required>
        <input type="tel" name="nomor_hp" placeholder="Nomor HP" required>

        <select name="program" required>
            <option value="">Pilih Program</option>
            <option value="Talkshow">Talkshow</option>
            <option value="Kuliner">Kuliner</option>
            <option value="Podcast">Podcast</option>
            <option value="Adventure">Adventure</option>
        </select>

        <button type="submit">Daftar Sekarang</button>
    </form>
</section>

<footer>
    <p>Bina Darma TV © 2026 | Universitas Bina Darma Palembang</p>
</footer>

</body>
</html>
