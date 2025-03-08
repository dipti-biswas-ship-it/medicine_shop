<?php
include "navbar.php";
include "includes/db.php"; // Ensure correct path

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = mysqli_real_escape_string($con, $_POST['name']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);
    $subject = mysqli_real_escape_string($con, $_POST['subject']);
    $message = mysqli_real_escape_string($con, $_POST['message']);

    $sql = "INSERT INTO contact_us (message,	email,	phone,	add_on,	subject) 
            VALUES ( '$message','$email', '$phone', NOW() ,'$subject')";

    if (mysqli_query($con, $sql)) {
        echo "<script>alert('Your message has been sent successfully!'); window.location.href='contact.php';</script>";
    } else {
        echo "<script>alert('Error: Could not submit your request.');</script>";
    }
}

?>

<section class="contact-us section">
    <div class="container">
        <div class="inner">
            <div class="row"> 
                <div class="col-lg-6">
                    <div class="contact-us-left">
                        <div id="myMap"> <img src="img/about-img.jpg" alt=""></div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="contact-us-form">
                        <h2>Contact With Us</h2>
                        <p>If you have any questions, please feel free to contact us.</p>
                        <form method="post">
                            <div class="row">
                                <div class="col-lg-6">
                                    <input type="text" name="name" placeholder="Name" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="email" name="email" placeholder="Email" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="phone" placeholder="Phone" required>
                                </div>
                                <div class="col-lg-6">
                                    <input type="text" name="subject" placeholder="Subject" required>
                                </div>
                                <div class="col-lg-12">
                                    <textarea name="message" placeholder="Your Message" required></textarea>
                                </div>
                                <div class="col-12">
                                    <button class="btn" type="submit">Send</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<style>
	/* Contact Us Section */
.contact-us {
    padding: 80px 0;
    background: #f8f9fa;
}

.contact-us .container {
    max-width: 1100px;
    margin: auto;
}

.contact-us .inner {
    background: #fff;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
    overflow: hidden;
}

.contact-us .row {
    display: flex;
    flex-wrap: wrap;
}

.contact-us-left {
    width: 100%;
    height: 100%;
    min-height: 350px;
    background: #e3f2fd;
    border-radius: 12px 0 0 12px;
}

#myMap {
    width: 100%;
    height: 100%;
    border-radius: 12px 0 0 12px;
}

/* Contact Us Form */
.contact-us-form {
    padding: 40px;
    text-align: left;
}

.contact-us-form h2 {
    font-size: 26px;
    font-weight: bold;
    color: #333;
    margin-bottom: 15px;
}

.contact-us-form p {
    font-size: 16px;
    color: #666;
    margin-bottom: 25px;
}

/* Form Inputs */
.contact-us-form input,
.contact-us-form textarea {
    width: 100%;
    padding: 12px;
    margin-bottom: 15px;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 16px;
    outline: none;
    transition: 0.3s ease-in-out;
}

.contact-us-form input:focus,
.contact-us-form textarea:focus {
    border-color: #0288d1;
    box-shadow: 0 0 5px rgba(2, 136, 209, 0.5);
}

/* Textarea Styling */
.contact-us-form textarea {
    height: 120px;
    resize: none;
}

/* Submit Button */
.contact-us-form .btn {
    width: 100%;
    background: #0288d1;
    border: none;
    padding: 12px;
    color: white;
    font-size: 18px;
    font-weight: bold;
    border-radius: 8px;
    cursor: pointer;
    transition: 0.3s;
}

.contact-us-form .btn:hover {
    background: #026aa7;
    transform: scale(1.03);
}

/* Responsive */
@media (max-width: 768px) {
    .contact-us .row {
        flex-direction: column;
    }

    .contact-us-left {
        border-radius: 12px 12px 0 0;
        min-height: 250px;
    }

    #myMap {
        border-radius: 12px 12px 0 0;
    }

    .contact-us-form {
        padding: 30px;
    }
}

</style>

<?php require('footer.php'); ?>