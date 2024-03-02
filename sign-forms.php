<?php

include 'config.php';

function signForms(){
    echo "
    <!-- Sign in -->
    <div class='l sign-body transition-fade' style='display: none;'>
        <div class='home-sign'>
            <!-- Exit Icon -->
            <h1 class='signX'>x</h1>
            <!-- Sign In Title -->
            <h1 class='sign-title'>
                Log In
            </h1>
            <form action='' method='post' id='loginF'>
                <!-- Email -->
                <label class='sign-lbl' for='email'>Email</label>
                <div class='input-field log-in-user'>
                    <input class='sign-in-input' type='email' id='sign-in-user' placeholder='Email' name='email'>
                    <small></small>
                </div>
                <!-- Password -->
                <label class='sign-lbl' for='password'>Password</label>
                <div class='input-field'>
                    <input class='sign-in-input sign-in-pass' type='password' name='password' placeholder='Password' id='sign-in-pass'>
                    <i class='far fa-eye-slash togglePassword' id='pass1'></i>
                    <small></small>
                </div>
                <div class='check'>
                    <input type='checkbox' name='rem' id='rem'>
                    <label for='rem'>Remember Me?</label>
                </div>
                
                <!-- Submit Button -->
                <button class='sign-btn-submit' id='sign-in-btn-submit'>Log In</button>
            </form>
        </div>
    </div>

    <!-- Sign up -->
    <div class='s sign-body transition-fade' style='display: none;'>
        <div class='home-sign'>
            <!-- Exit Icon -->
            <h1 class='signX'>x</h1>
            <!-- Sign Up Title -->
            <h1 class='sign-title'>
                Sign Up
            </h1>
            <form action='signup.php' method='post' class='forms' id='signupF'>
                <section class='form-section'>
                    <div class='form-section-names'>
                        <!-- First Name  -->
                        <div class='input-field First-Name'>
                            <div>
                                <label for='frst-name-Input' class='sign-lbl'>First Name</label>
                                <span class='required'>*</span>
                            </div>
                            <input type='text' placeholder='First Name' name='frst-name-Input' class='sign-up-input' id='frst-name-Input'>
                            <small>Error Message</small>
                        </div>
                        <!-- Last Name  -->
                        <div class='input-field Last-Name'>
                            <div>
                                <label for='lst-name-Input' class='sign-lbl'>Last Name</label>
                                <span class='required'>*</span>
                            </div>
                            <input type='text' placeholder='Last Name' name='lst-name-Input' class='sign-up-input' id='lst-name-Input'>
                            <small>Error Message</small>
                        </div>
                    </div>
                    <div class='form-section-contact'>
                        <!-- Email-->
                        <div class='input-field contact'>
                            <div>
                                <label for='ContactInput' class='sign-lbl'>Email</label>
                                <span class='required'>*</span>
                            </div>
                            <input type='text' placeholder='Email' name='ContactInput' class='sign-up-input' id='ContactInput'>
                            <small>Error Message</small>
                        </div>
                        <!-- Birthday -->
                        <div class='input-field Date'>
                            <div>
                                <label for='dateInput' class='sign-lbl'>Birthday</label>
                                <span class='required'>*</span>
                            </div>
                            <input type='date' placeholder='DD/MM/YYYY' class='sign-up-input' id='bday' name='bday'>
                            <small>Error Message</small>
                        </div>
                    </div>
                </section>
                <div class='form-section info'>
                    <div class='pass'>
                        <!-- Password -->
                        <div class='input-field password'>
                            <div>
                                <label for='password' class='sign-lbl'>Password</label>
                                <span class='required'>*</span>
                            </div>
                            <div class='input-field'>
                                <input type='password' placeholder='Password' class='sign-up-input' id='password' name='password'>
                                <i class='far fa-eye-slash fa-sm togglePassword' id='pass2'></i>
                                <small>Error Message</small>
                            </div>  
                        </div>
                        <!-- Confirm Password -->
                        <div class='input-field confirm-password'>
                            <div>
                                <label for='confirmPassword' class='sign-lbl'>Confirm Password</label>
                                <span class='required'>*</span>
                            </div>
                            <div class='input-field'>
                                <input type='password' placeholder='Confirm Password' class='sign-up-input' id='confirmPassword' name='confirmPassword'>
                                <i class='far fa-eye-slash fa-sm togglePassword' id='pass3'></i>
                                <small>Error Message</small>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Submit Button -->
                <div class='input-box button'>
                    <button type='submit' id='btn' class='sign-btn-submit'>Register Now</button>
                </div>            
            </form>                     
        </div>
    </div>

    <!-- backdrop -->
    <div id='backdrop' style='display: none'></div>
    ";
}
?>