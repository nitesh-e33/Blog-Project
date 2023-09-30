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
    <div class="article">
          <p class="meta">{{ucwords($blog->category_name)}}</p><br>
          <h2>{{$blog->title}}</h2>
          <p class="meta">Posted on {{$blog->created_at}} by {{ucwords($blog->name)}}</p>
          <p>{{$blog->description}}</p><br>
          <img src="{{ asset('uploads/customers/'.$blog->image) }}" alt="Sample Image" width="300" height="200" style="float: left; margin-right: 20px;"><br>
    </div>
    </main>
</body>

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

</html>

<style>

.text {
  display: block;
  /* width: 100px; */
  overflow: hidden;
  white-space: nowrap;
  text-overflow: ellipsis;
  max-width: 300ch;
}

body, h1, h2, p, ul, li {
    margin: 0;
    padding: 0;
}

body {
    font-family: Arial, sans-serif;
    background-color: #fff;
}

.header-button {
    float: right; 
    margin-top: auto; 
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
    height: auto;
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
    /* background-color: #fff; */
    /* border: 1px solid #ccc; */
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
    color: #333;
}
.spacing {
    margin-right: 15px;
}
footer {
    color: #333;
    text-align: center;
    padding: 10px;
    margin-bottom: 0%;
}

</style>

