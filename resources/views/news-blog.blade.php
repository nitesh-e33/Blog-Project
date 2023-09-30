<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>News Blog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="header-button">
            <a href="/my-account" class="button">Dashboard</a>
        </div> 
        <h1>News Blog</h1>
        <nav>
            <ul>
                <li><a href="/news-blog">Home</a></li>
                <li><a href="/category-news">Categories</a></li>
                <li><a href="/about-news">About Us</a></li>
                <li><a href="/contact-news">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="article">
            <img src="sample-image.jpg" alt="Sample Image" width="200" height="150" style="float: left; margin-right: 20px;">
            <h2>Tech Giants Unveil New Gadgets at Annual Conference</h2>
            <!-- <a href="">Tech Giants Unveil New Gadgets at Annual Conference</a> -->
            <p class="meta">Posted on September 17, 2023 by John Doe</p>
            <p>In a highly anticipated event, tech giants showcased their latest innovations. From smartphones with groundbreaking features to futuristic wearable tech.</p>
            <a href="#">Read More</a>
        </section>

        <section class="article">
            <img src="sample-image.jpg" alt="Sample Image" width="200" height="150" style="float: left; margin-right: 20px;">
            <h2>Sample Article Title 2</h2>
            <p class="meta">Posted on September 17, 2023 by John Doe</p>
            <p class="short-description">
                Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in magna at ex feugiat vehicula at a erat.
            </p>
            <a href="#" onclick="toggleDescription()">Read More</a>
        </section>


        <section class="article">
            <img src="sample-image.jpg" alt="Sample Image" width="200" height="150" style="float: left; margin-right: 20px;">
            <h2>Sample Article Title 3</h2>
            <p class="meta">Posted on September 17, 2023 by John Doe</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in magna at ex feugiat vehicula at a erat.</p>
            <a href="#">Read More</a>
        </section>
        <section class="article">
            <img src="sample-image.jpg" alt="Sample Image" width="200" height="150" style="float: left; margin-right: 20px;">            
            <h2>Sample Article Title 4</h2>
            <p class="meta">Posted on September 17, 2023 by John Doe</p>
            <!-- <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in magna at ex feugiat vehicula at a erat.</p> -->
            <span class="text" >Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nullam in magna at ex feugiat vehicula at a erat.</span>
            <a href="#">Read More</a>
        </section>
    </main>

    <footer>
        <div class="footer-content">
            <div class="footer-links">
                <ul>
                    <a href="#">Privacy Policy <span class="spacing"></span></a>
                    <a href="#">Terms of Service</a>
                </ul>
            </div>
        </div>
        <p>&copy; 2023 News Blog</p>
    </footer>

    <!-- <script>
        function toggleDescription() {
            var shortDesc = document.querySelector('.short-description');
            var fullDesc = document.querySelector('.full-description');
            var readMoreLink = document.querySelector('a[href="#"]');

            if (fullDesc.style.display === 'none') {
                fullDesc.style.display = 'block';
                shortDesc.style.display = 'none';
                readMoreLink.textContent = 'Read Less';
            } else {
                fullDesc.style.display = 'none';
                shortDesc.style.display = 'block';
                readMoreLink.textContent = 'Read More';
            }
        }
    </script> -->

</html>

<style>

.text {
  display: block;
  /* width: 100px; */
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  max-width: 30ch;
}

body, h1, h2, p, ul, li {
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #f0f0f0;
}

.header-button {
    float: right; 
    margin-top: 20px; 
}

.button {
    display: inline-block;
    padding: 10px 20px;
    background-color: #888;
    color: #fff;
    text-decoration: none;
    border-radius: 5px;
}

.button:hover {
    background-color: #0056b3;
}

header {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 1rem 0;
}

header h1 {
    font-size: 2rem;
}

nav ul {
    list-style-type: none;
}

nav ul li {
    display: inline;
    margin-right: 20px;
}

nav a {
    text-decoration: none;
    color: #fff;
    font-weight: bold;
}

main {
    max-width: 800px;
    margin: 0 auto;
    padding: 20px;
}

.article {
    background-color: #fff;
    border: 1px solid #ccc;
    padding: 20px;
    margin-bottom: 20px;
}

.article h2 {
    font-size: 1.5rem;
    margin-bottom: 10px;
}

.article .meta {
    color: #888;
    font-size: 0.8rem;
}

.article p {
    line-height: 1.5;
}

.article a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

.footer-links a {
    color: #fff;
}
.spacing {
    margin-right: 15px;
}
footer {
    background-color: #333;
    color: #fff;
    text-align: center;
    padding: 10px;
}


</style>