<?
use yii\bootstrap\Nav;
?>
<!-- Header Starts -->
<div class="navbar-wrapper">

    <div class="navbar-inverse" role="navigation">
        <div class="container">
            <div class="navbar-header">


                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

            </div>


            <!-- Nav Starts -->
            <div class="navbar-collapse  collapse">
                <?
                $menuItems = [
                    ['label' => 'Home', 'url' => '#'],
                    ['label' => 'About', 'url' => '#'],
                    ['label' => 'Agents', 'url' => '#'],
                    ['label' => 'Blog', 'url' => '#'],
                    ['label' => 'Contact', 'url' => '#'],
                ];
                echo Nav::widget([
                    'options' => ['class' => 'navbar-nav navbar-right"'],
                    'items' => $menuItems,
                ]);
                ?>
               <!-- <ul class="nav navbar-nav navbar-right">
                    <li class="active"><a href="index.html" >Home</a></li>
                    <li><a href="about.html" >About</a></li>
                    <li><a href="agents.html" >Agents</a></li>
                    <li><a href="blog.html" >Blog</a></li>
                    <li><a href="contact.html" >Contact</a></li>
                </ul>-->
            </div>
            <!-- #Nav Ends -->

        </div>
    </div>

</div>
<!-- #Header Starts -->





<div class="container">

    <!-- Header Starts -->
    <div class="header">
        <a href="/" ><img src="/images/logo.png"  alt="Realestate"></a>
        <?
        $menuItems = [];
        if(Yii::$app->user->isGuest) {
            $menuItems[] =  ['label' => 'Login', 'url' => '#', 'linkOptions' => ['data-target' => '#loginpop', 'data-toggle' => "modal"]];
        }
        else{
            $menuItems[] =  ['label' => 'Manager adverts', 'url' => ['/cabinet/advert']];
            $menuItems[] = ['label' => 'Logout',  'url' => ['/site/logout'], 'linkOptions' => ['data-method' => 'post']];
        }
        echo Nav::widget([
            'options' => ['class' => 'pull-right'],
            'items' => $menuItems,
        ]);
        ?>
        <!--<ul class="pull-right">
            <li><a href="buysalerent.html" >Buy</a></li>
            <li><a href="buysalerent.html" >Sale</a></li>
            <li><a href="buysalerent.html" >Rent</a></li>
        </ul>-->
    </div>
    <!-- #Header Starts -->
</div>