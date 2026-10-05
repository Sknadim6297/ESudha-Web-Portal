<div class="header">
    <div class="w3layouts_header_right">
        <div class="agileits-social top_content">
            <ul>
                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                <li><a href="#"><i class="fa fa-rss"></i></a></li>
                <li><a href="#"><i class="fa fa-vk"></i></a></li>
            </ul>
        </div>
    </div>
    <div class="w3layouts_header_left">
        <ul>
            <li><a href="#" data-toggle="modal" data-target="#myModal2"><i class="fa fa-user" aria-hidden="true"></i><?php echo $headerLabelSpacing; ?>Sign in</a></li>
            <li><a href="#" data-toggle="modal" data-target="#myModal3"><i class="fa fa-pencil-square-o" aria-hidden="true"></i><?php echo $headerLabelSpacing; ?>Sign up</a></li>
        </ul>
    </div>
    <div class="clearfix"></div>
</div>
<div class="banner">
    <nav class="navbar navbar-default">
        <div class="navbar-header navbar-left">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <h1><a class="navbar-brand" href="index.php"><img src="images/logo1.png" class="img-responsive" style="width:210px;"></a></h1>
        </div>
        <div class="collapse navbar-collapse navbar-right" id="bs-example-navbar-collapse-1">
            <nav class="link-effect-2" id="link-effect-2">
                <ul class="nav navbar-nav">
                    <li<?php echo $headerActivePage === 'home' ? ' class="active"' : ''; ?>><a href="index.php"><span data-hover="Home">Home</span></a></li>
                    <li<?php echo $headerActivePage === 'about' ? ' class="active"' : ''; ?>><a href="about.php"><span data-hover="About Us">About Us</span></a></li>
                    <li<?php echo $headerActivePage === 'shopkeepers' ? ' class="active"' : ''; ?>><a href="shopkeepers.php"><span data-hover="Shopkeeper">Shopkeeper</span></a></li>
                    <li<?php echo $headerActivePage === 'agency' ? ' class="active"' : ''; ?>><a href="implementing-agency.php"><span data-hover="Implementing Agency">Implementing Agency</span></a></li>
                    <li<?php echo $headerActivePage === 'contact' ? ' class="active"' : ''; ?>><a href="mail.php"><span data-hover="Contact Us">Contact Us</span></a></li>
                </ul>
            </nav>
        </div>
    </nav>
</div>
