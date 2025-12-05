<style>
        footer {
            background: linear-gradient(135deg, #0047AB 0%, #0066FF 100%);
            color: var(--white);
            padding: 4rem 2rem 2rem;
            margin-top: 5rem;
            position: relative;
            overflow: hidden;
        }

        footer::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 1px;
            background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.3), transparent);
        }

        .footer-content {
            max-width: 1400px;
            margin: 0 auto;
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 3rem;
            margin-bottom: 2rem;
        }

        .footer-section h3 {
            font-size: 1.3rem;
            margin-bottom: 1.5rem;
            font-weight: 700;
            position: relative;
            display: inline-block;
        }

        .footer-section h3::after {
            content: '';
            position: absolute;
            bottom: -8px;
            left: 0;
            width: 50px;
            height: 3px;
            background: var(--white);
            border-radius: 3px;
        }

        .footer-section p {
            line-height: 1.8;
            color: rgba(255, 255, 255, 0.9);
            margin-bottom: 1.5rem;
        }

        .footer-links {
            list-style: none;
        }

        .footer-links li {
            margin-bottom: 0.8rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
        }

        .footer-links a:hover {
            color: var(--white);
            transform: translateX(5px);
        }

        .footer-links a i {
            font-size: 0.8rem;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .footer-links a:hover i {
            opacity: 1;
        }

        .social-links {
            display: flex;
            gap: 1rem;
            margin-top: 1.5rem;
        }

        .social-links a {
            width: 45px;
            height: 45px;
            border-radius: 50%;
            background: rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            justify-content: center;
            color: var(--white);
            text-decoration: none;
            transition: all 0.3s ease;
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .social-links a:hover {
            background: var(--white);
            color: var(--primary-blue);
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
        }

        .contact-info {
            list-style: none;
        }

        .contact-info li {
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.8rem;
            color: rgba(255, 255, 255, 0.9);
        }

        .contact-info i {
            width: 20px;
            color: var(--white);
        }

        .contact-info a {
            color: rgba(255, 255, 255, 0.9);
            text-decoration: none;
            transition: color 0.3s ease;
        }

        .contact-info a:hover {
            color: var(--white);
        }

        .newsletter {
            margin-top: 1.5rem;
        }

        .newsletter-form {
            display: flex;
            gap: 0.5rem;
            margin-top: 1rem;
        }

        .newsletter-form input {
            flex: 1;
            padding: 0.8rem 1rem;
            border: 2px solid rgba(255, 255, 255, 0.2);
            border-radius: 50px;
            background: rgba(255, 255, 255, 0.1);
            color: var(--white);
            font-size: 0.95rem;
            transition: all 0.3s ease;
        }

        .newsletter-form input::placeholder {
            color: rgba(255, 255, 255, 0.6);
        }

        .newsletter-form input:focus {
            outline: none;
            border-color: var(--white);
            background: rgba(255, 255, 255, 0.15);
        }

        .newsletter-form button {
            padding: 0.8rem 1.5rem;
            border: none;
            border-radius: 50px;
            background: var(--white);
            color: var(--primary-blue);
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .newsletter-form button:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(255, 255, 255, 0.3);
        }

        .footer-bottom {
            max-width: 1400px;
            margin: 0 auto;
            padding-top: 2rem;
            border-top: 1px solid rgba(255, 255, 255, 0.2);
            text-align: center;
            color: rgba(255, 255, 255, 0.8);
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .footer-bottom p {
            margin: 0;
        }

        .footer-bottom a {
            color: var(--white);
            text-decoration: none;
            font-weight: 600;
            transition: opacity 0.3s ease;
        }

        .footer-bottom a:hover {
            opacity: 0.8;
        }

        .footer-links-bottom {
            display: flex;
            gap: 2rem;
            flex-wrap: wrap;
        }

        .footer-links-bottom a {
            color: rgba(255, 255, 255, 0.8);
            text-decoration: none;
            font-size: 0.9rem;
            transition: color 0.3s ease;
        }

        .footer-links-bottom a:hover {
            color: var(--white);
        }

        .back-to-top {
            position: fixed;
            bottom: 30px;
            right: 30px;
            width: 50px;
            height: 50px;
            background: var(--primary-blue);
            color: var(--white);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            opacity: 0;
            visibility: hidden;
            transition: all 0.3s ease;
            z-index: 999;
            box-shadow: 0 4px 15px rgba(0, 102, 255, 0.3);
        }

        .back-to-top.visible {
            opacity: 1;
            visibility: visible;
        }

        .back-to-top:hover {
            background: var(--dark-blue);
            transform: translateY(-5px);
            box-shadow: 0 6px 20px rgba(0, 102, 255, 0.4);
        }

        @media (max-width: 768px) {
            footer {
                padding: 3rem 1.5rem 1.5rem;
            }

            .footer-content {
                grid-template-columns: 1fr;
                gap: 2rem;
            }

            .footer-bottom {
                flex-direction: column;
                text-align: center;
            }

            .footer-links-bottom {
                justify-content: center;
            }

            .newsletter-form {
                flex-direction: column;
            }

            .newsletter-form button {
                justify-content: center;
            }

            .back-to-top {
                bottom: 20px;
                right: 20px;
                width: 45px;
                height: 45px;
            }
        }
    </style>

    <footer>
        <div class="footer-content">
            <div class="footer-section">
                <h3>HORIZON TECH</h3>
                <p>Transforming ideas into powerful digital solutions. We build innovative software, websites, and AI-powered systems for the future.</p>
                <div class="social-links">
                    <a href="#" aria-label="Facebook" title="Facebook"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" aria-label="Twitter" title="Twitter"><i class="fab fa-twitter"></i></a>
                    <a href="#" aria-label="LinkedIn" title="LinkedIn"><i class="fab fa-linkedin-in"></i></a>
                    <a href="#" aria-label="Instagram" title="Instagram"><i class="fab fa-instagram"></i></a>
                    <a href="#" aria-label="GitHub" title="GitHub"><i class="fab fa-github"></i></a>
                </div>
            </div>

            <div class="footer-section">
                <h3>Quick Links</h3>
                <ul class="footer-links">
                    <li><a href="home.php"><i class="fas fa-chevron-right"></i> Home</a></li>
                    <li><a href="services.php"><i class="fas fa-chevron-right"></i> Services</a></li>
                    <li><a href="projects.php"><i class="fas fa-chevron-right"></i> Projects</a></li>
                    <li><a href="about.php"><i class="fas fa-chevron-right"></i> About Us</a></li>
                    <li><a href="contact.php"><i class="fas fa-chevron-right"></i> Contact</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Services</h3>
                <ul class="footer-links">
                    <li><a href="services.php#web"><i class="fas fa-chevron-right"></i> Website Development</a></li>
                    <li><a href="services.php#webapp"><i class="fas fa-chevron-right"></i> Web Applications</a></li>
                    <li><a href="services.php#ai"><i class="fas fa-chevron-right"></i> AI-Powered Systems</a></li>
                    <li><a href="services.php#design"><i class="fas fa-chevron-right"></i> Graphics Design</a></li>
                    <li><a href="services.php#seo"><i class="fas fa-chevron-right"></i> SEO & Marketing</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h3>Contact Info</h3>
                <ul class="contact-info">
                    <li><i class="fas fa-map-marker-alt"></i> Douala, Cameroon</li>
                    <li><i class="fas fa-phone"></i> <a href="tel:+237XXXXXXXXX">+237 XXX XXX XXX</a></li>
                    <li><i class="fas fa-envelope"></i> <a href="mailto:info@horizontech.com">info@horizontech.com</a></li>
                    <li><i class="fas fa-clock"></i> Mon - Fri: 9AM - 6PM</li>
                </ul>
                <div class="newsletter">
                    <p style="margin-bottom: 0.5rem; font-weight: 600;">Subscribe to Newsletter</p>
                    <form class="newsletter-form" onsubmit="return handleNewsletter(event)">
                        <input type="email" placeholder="Your email" required>
                        <button type="submit">
                            <i class="fas fa-paper-plane"></i>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?php echo date('Y'); ?> <a href="home.php">Horizon Tech Solution</a>. All Rights Reserved.</p>
            <div class="footer-links-bottom">
                <a href="#">Privacy Policy</a>
                <a href="#">Terms of Service</a>
                <a href="#">Cookie Policy</a>
            </div>
            <p>Designed with <i class="fas fa-heart" style="color: #ff6b6b;"></i> by Horizon Tech</p>
        </div>
    </footer>

    <div class="back-to-top" id="backToTop">
        <i class="fas fa-arrow-up"></i>
    </div>

    <script>
        // Back to top button
        const backToTop = document.getElementById('backToTop');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 300) {
                backToTop.classList.add('visible');
            } else {
                backToTop.classList.remove('visible');
            }
        });

        backToTop.addEventListener('click', () => {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        });

        // Smooth scroll for all anchor links
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                const href = this.getAttribute('href');
                if (href !== '#' && href !== '#!') {
                    e.preventDefault();
                    const target = document.querySelector(href);
                    if (target) {
                        target.scrollIntoView({
                            behavior: 'smooth',
                            block: 'start'
                        });
                    }
                }
            });
        });

        // Newsletter subscription handler
        function handleNewsletter(e) {
            e.preventDefault();
            const email = e.target.querySelector('input[type="email"]').value;
            
            // Here you would normally send this to your backend
            alert('Thank you for subscribing! We\'ll keep you updated with our latest news.');
            e.target.reset();
            
            return false;
        }

        // Add animation on scroll for footer
        const footerObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.animation = 'fadeInUp 0.8s ease forwards';
                }
            });
        }, { threshold: 0.1 });

        document.querySelectorAll('.footer-section').forEach(section => {
            footerObserver.observe(section);
        });
    </script>
</body>
</html>