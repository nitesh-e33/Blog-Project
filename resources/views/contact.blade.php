<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - News Blog</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <header>
        <div class="header-button">
            <!-- <a href="/my-account" class="button">Dashboard</a> -->
        </div>
        <h1>News Blog</h1>
        <nav>
            <ul>
                <li><a href="/">Home</a></li>
                <!-- <li><a href="/category-info">Categories</a></li> -->
                <li><a href="/about-info">About Us</a></li>
                <li><a href="/contact-info">Contact</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="contact">
            <h2>Contact Us</h2>
            <p>If you have any questions or feedback, please feel free to contact us using the form below:</p><br>
            
    <form action="/user-feedback" method="POST">
    @csrf
    <div class="container">         
            <div class="input-control">
                <label for="username">Name</label>
                <input id="username" name="username" type="text">
            </div>
            <div class="input-control">
                <label for="email">Email</label>
                <input id="email" name="email" type="text">              
            </div>
            <div class="input-control">
                <label for="description">Message</label>
                <textarea id="description" name="description" rows="5" cols="20"></textarea>
            </div>
            <button type="submit" class="submit">Submit</button>   
    </div>

    </form>
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

</body>
</html>

<style>
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
    /* text-align: center; */
    padding: 1rem 0;
}

header h1 {
    font-size: 2rem;
}

nav ul {
    list-style-type: none;
    margin-left: 500px;
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


#form {
    width: 300px;
    margin: 20vh auto 0 auto;
    padding: 20px;
    background-color: whitesmoke;
    border-radius: 4px;
    font-size: 12px;
}

#form h1 {
    color: #0f2027;
    text-align: center;
}

#form button {
    padding: 10px;
    margin-top: 10px;
    width: 100%;
    color: white;
    background-color: rgb(41, 57, 194);
    border: none;
    border-radius: 4px;
}

.input-control {
    display: flex;
    flex-direction: column;
}

.input-control input {
    border: 2px solid #f0f0f0;
	border-radius: 4px;
	display: block;
	font-size: 12px;
	padding: 10px;
	width: 50%;
}

.input-control input:focus {
    outline: 0;
}

.input-control.success input {
    border-color: #09c372;
}

.input-control.error input {
    border-color: #ff3860;
}

.input-control .error {
    color: #ff3860;
    font-size: 9px;
    height: 13px;
}


.footer-links a {
    color: #333;
}
.spacing {
    margin-right: 15px;
}
footer {
    color: #333;
    text-align: center;
    /* position: fixed;
    bottom: 0; */
    padding: 10px;
}

</style>
