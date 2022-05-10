        <div class="slider">
        	<section id="contact-page" style="background-color: #d5d9e0; min-height: 462px;">
                <div class="container">
                    <div class="center" style="padding-bottom: 0px;">        
                        <h2>Drop Your Message</h2>
                    </div> 
                    <div class="row contact-wrap" style="color: white;"> 
                        <div class="status alert alert-success" style="display: none"></div>
                        <form id="main-contact-form" class="contact-form" name="contact-form" method="post" action="sendemail.php" style="padding-top: 1px">
                        <?=get_csrf_token()?>
                            <div class="col-sm-5 col-sm-offset-1">
                                <div class="form-group">
                                    <label>Name</label>
                                    <input type="text" name="name" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label>Phone</label>
                                    <input type="text" class="form-control">
                                </div>
                                <div class="form-group">
                                    <label>Company Name</label>
                                    <input type="text" class="form-control">
                                </div>                        
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group">
                                    <label>Subject</label>
                                    <input type="text" name="subject" class="form-control" required="required">
                                </div>
                                <div class="form-group">
                                    <label>Message</label>
                                    <textarea name="message" id="message" required="required" class="form-control" rows="8"></textarea>
                                </div>                        
                                <div class="form-group" style="float:right; margin-top: 20px">
                                    <button type="button" name="submit" required="required">Submit Message</button>
                                </div>
                            </div>
                        </form> 
                    </div><!--/.row-->
                </div><!--/.container-->
            </section><!--/#contact-page-->
        </div>
    </body>
</html>