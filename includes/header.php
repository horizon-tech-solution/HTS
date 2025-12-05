<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo isset($pageTitle) ? $pageTitle . ' - ' : ''; ?>Horizon Tech Solution</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        :root {
            --primary-blue: #0066FF;
            --dark-blue: #0047AB;
            --accent-blue: #00D4FF;
            --white: #FFFFFF;
            --text-dark: #1A1A1A;
            --text-gray: #6B7280;
            --border-color: rgba(0, 102, 255, 0.1);
            --glass-bg: rgba(255, 255, 255, 0.75);
        }

        body {
            font-family: 'Inter', sans-serif;
            color: var(--text-dark);
            background: var(--white);
            overflow-x: hidden;
        }

        /* Header Styles */
        header {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: 1000;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        }

        header::before {
            content: '';
            position: absolute;
            inset: 0;
            background: var(--glass-bg);
            backdrop-filter: blur(20px) saturate(180%);
            -webkit-backdrop-filter: blur(20px) saturate(180%);
            border-bottom: 1px solid var(--border-color);
            transition: all 0.4s ease;
        }

        header.scrolled::before {
            background: rgba(255, 255, 255, 0.9);
            box-shadow: 0 8px 32px rgba(0, 102, 255, 0.12);
            border-bottom: 1px solid rgba(0, 102, 255, 0.15);
        }

        nav {
            position: relative;
            max-width: 1400px;
            margin: 0 auto;
            padding: 1.2rem 2.5rem;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        /* Logo */
        .logo {
            font-size: 1.5rem;
            font-weight: 800;
            color: var(--primary-blue);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 0.7rem;
            transition: all 0.3s ease;
            position: relative;
        }

        .logo i {
            font-size: 1.8rem;
            width: 42px;
            height: 42px;
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--accent-blue) 100%);
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            box-shadow: 0 4px 15px rgba(0, 102, 255, 0.25);
            transition: all 0.3s ease;
        }

        .logo:hover i {
            transform: rotate(10deg) scale(1.08);
            box-shadow: 0 6px 20px rgba(0, 102, 255, 0.35);
        }

        .logo span {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            letter-spacing: -0.5px;
        }

        /* Navigation Links */
        .nav-links {
            display: flex;
            list-style: none;
            gap: 0.5rem;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: var(--text-dark);
            font-weight: 600;
            font-size: 0.95rem;
            padding: 0.7rem 1.2rem;
            border-radius: 12px;
            position: relative;
            transition: all 0.3s ease;
            display: block;
        }

        .nav-links a::before {
            content: '';
            position: absolute;
            inset: 0;
            background: #F3F4F6;
            border-radius: 12px;
            opacity: 0;
            transition: all 0.3s ease;
            z-index: -1;
        }

        .nav-links a:hover {
            color: var(--primary-blue);
            transform: translateY(-2px);
        }

        .nav-links a:hover::before {
            opacity: 1;
        }

        .nav-links a.active {
            color: var(--primary-blue);
            background: rgba(0, 102, 255, 0.08);
        }

        /* CTA Button */
        .cta-btn {
            background: linear-gradient(135deg, var(--primary-blue) 0%, var(--dark-blue) 100%) !important;
            color: var(--white) !important;
            padding: 0.75rem 2rem !important;
            border-radius: 50px;
            font-weight: 600;
            position: relative;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 102, 255, 0.3);
        }

        .cta-btn::before {
            background: linear-gradient(135deg, #4D94FF 0%, var(--primary-blue) 100%) !important;
            opacity: 0;
        }

        .cta-btn:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 8px 25px rgba(0, 102, 255, 0.4);
        }

        .cta-btn:hover::before {
            opacity: 1;
        }

        /* Mobile Toggle */
        .mobile-toggle {
            display: none;
            flex-direction: column;
            cursor: pointer;
            gap: 5px;
            padding: 8px;
            border-radius: 10px;
            transition: all 0.3s ease;
        }

        .mobile-toggle:hover {
            background: #F3F4F6;
        }

        .mobile-toggle span {
            width: 26px;
            height: 3px;
            background: var(--primary-blue);
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
            border-radius: 3px;
        }

        .mobile-toggle.active span:nth-child(1) {
            transform: rotate(45deg) translate(7px, 7px);
        }

        .mobile-toggle.active span:nth-child(2) {
            opacity: 0;
            transform: translateX(-10px);
        }

        .mobile-toggle.active span:nth-child(3) {
            transform: rotate(-45deg) translate(7px, -7px);
        }

        /* Responsive */
        @media (max-width: 968px) {
            .mobile-toggle {
                display: flex;
            }

            .nav-links {
                position: fixed;
                top: 80px;
                right: -100%;
                flex-direction: column;
                background: rgba(255, 255, 255, 0.98);
                backdrop-filter: blur(20px);
                width: 100%;
                max-width: 320px;
                padding: 2rem 1.5rem;
                box-shadow: -4px 0 30px rgba(0, 0, 0, 0.1);
                transition: right 0.4s cubic-bezier(0.4, 0, 0.2, 1);
                gap: 0.5rem;
                align-items: stretch;
                height: calc(100vh - 80px);
                overflow-y: auto;
            }

            .nav-links.active {
                right: 0;
            }

            .nav-links a {
                font-size: 1.05rem;
                padding: 1rem 1.2rem;
            }
        }

        @media (max-width: 768px) {
            nav {
                padding: 1rem 1.5rem;
            }

            .logo {
                font-size: 1.35rem;
            }

            .logo i {
                width: 38px;
                height: 38px;
                font-size: 1.5rem;
            }
        }
    </style>
</head>
<body>
    <header id="header">
        <nav>
            <a href="home.php" class="logo">
                <i class="fas fa-layer-group"></i>
                <span>HORIZON TECH</span>
            </a>
            
            <ul class="nav-links" id="navLinks">
                <li><a href="index.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'home.php' ? 'active' : ''; ?>">Home</a></li>
                <li><a href="services.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'services.php' ? 'active' : ''; ?>">Services</a></li>
                <li><a href="projects.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'projects.php' ? 'active' : ''; ?>">Projects</a></li>
                <li><a href="about.php" class="<?php echo basename($_SERVER['PHP_SELF']) == 'about.php' ? 'active' : ''; ?>">About Us</a></li>
                <li><a href="contact.php" class="cta-btn">Contact Us</a></li>
            </ul>

            <div class="mobile-toggle" id="mobileToggle">
                <span></span>
                <span></span>
                <span></span>
            </div>
        </nav>
    </header>

    <script>
        const header = document.getElementById('header');
        const mobileToggle = document.getElementById('mobileToggle');
        const navLinks = document.getElementById('navLinks');

        // Header scroll effect
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Mobile menu toggle
        mobileToggle.addEventListener('click', () => {
            mobileToggle.classList.toggle('active');
            navLinks.classList.toggle('active');
        });

        // Close mobile menu when clicking on a link
        document.querySelectorAll('.nav-links a').forEach(link => {
            link.addEventListener('click', () => {
                mobileToggle.classList.remove('active');
                navLinks.classList.remove('active');
            });
        });

        // Close mobile menu when clicking outside
        document.addEventListener('click', (e) => {
            if (!navLinks.contains(e.target) && !mobileToggle.contains(e.target)) {
                mobileToggle.classList.remove('active');
                navLinks.classList.remove('active');
            }
        });
    </script>