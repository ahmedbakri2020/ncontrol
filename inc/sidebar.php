<?php 
if($previlage=='All'){
    $previlage = 'All';
}else{
   $arr_prev = explode(',',$previlage)  ;
  
}
echo $auth;


?>
<div class="col-md-2 left-sidebar minified">
    <div class="sm-menu-control visible-xs visible-sm">
        <h5>Menu</h5>
        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-navbar" aria-expanded="false">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
        </button>
    </div>
    <ul id="bs-navbar" class="main-menu">
        <li class="active"><a href="<?php echo ADMIN_URL ?>" title=""><i class="fa fa-dashboard pull-left"></i> <span class="text">Dashboard</span></a></li>

        <?php if ($previlage == 'All' || in_array(1, $arr_prev)): ?>
            <li class="menu-toggle"><a href="#" title="" class="">
                    <i class="fa fa-newspaper-o pull-left"></i>
                    <span class="text">News</span>
                    <i class="fa fa-caret-right pull-right"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="index.php?page=news" title=""><i class="fa fa-newspaper-o"></i> <span>All News</span></a></li>
                    <?php if ($previlage == 'All'): ?>
                    <li><a href="index.php?page=category&cat=news" title=""><i class="fa fa-sitemap"></i> <span>Category</span></a></li>
                     <li><a href="index.php?page=category&cat=trends" title=""><i class="fa fa-user"></i> <span>Trending</span></a></li>

                  
                    <?php
                    endif;
                    ?>
                </ul>
            </li>
        <?php endif; ?>
             <?php if ($previlage == 'All' || in_array(5, $arr_prev)): ?>
               <li><a href="index.php?page=reporter" title=""><i class="fa fa-user"></i> <span>Reporter</span></a></li>
        <?php endif; ?>

        <?php if ($previlage == 'All' || in_array(2, $arr_prev)): ?>
            <li><a href="index.php?page=advertisement" title=""><i class="fa fa-bullhorn"></i> <span>Advertisement</span></a></li>
        <?php endif; ?>
           <?php //if ($previlage == 'All'): ?>
        <li class="menu-toggle"><a href="#" title="" class="">
                    <i class="fa fa-plus pull-left"></i>
                    <span class="text">Election </span>
                    <i class="fa fa-caret-right pull-right"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="index.php?page=candidate"  title=""><i class="fa fa-pencil"></i> <span>Manage Election </span></a></li>
                      <li><a href="index.php?page=election_display" title=""><i class="fa fa-pencil"></i> <span>Manage Display Section</span></a></li>
                     <li><a href="index.php?page=party" title=""><i class="fa fa-pencil"></i> <span>Party</span></a></li>
                       <li><a href="index.php?page=pradesh" title=""><i class="fa fa-pencil"></i> <span>Pradesh</span></a></li>
                    <li><a href="index.php?page=manage_cat&category=district" title=""><i class="fa fa-pencil"></i> <span>District</span></a></li>
                    <li><a href="index.php?page=constituency " title=""><i class="fa fa-pencil"></i> <span>Constituency</span></a></li>
                     <!--<li><a href="index.php?page=palika_division" title=""><i class="fa fa-pencil"></i> <span>Local Level</span></a></li>-->
                      <!--<li><a href="index.php?page=ward" title=""><i class="fa fa-pencil"></i> <span>Ward</span></a></li>-->
                </ul>
            </li>
             <li class="menu-toggle"><a href="#" title="" class="">
                    <i class="fa fa-plus pull-left"></i>
                    <span class="text">ReElection </span>
                    <i class="fa fa-caret-right pull-right"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="index.php?page=recandidates"  title=""><i class="fa fa-pencil"></i> <span>Manage Election </span></a></li>
                      <li><a href="index.php?page=reelection_display" title=""><i class="fa fa-pencil"></i> <span>Manage Display Section</span></a></li>
                </ul>
            </li>
            <?php
            //endif;?>
        
        <?php if ($previlage == 'All' || in_array(4, $arr_prev)): ?>
           
               <li class="menu-toggle"><a href="#" title="" class="">
                    <i class="glyphicon glyphicon-book"></i>
                    <span class="text">NayaPatrika Epaper</span>
                    <i class="fa fa-caret-right pull-right"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="index.php?page=epaper-pdf" title=""><i class="fa fa-book"></i><span>Manage Epaper</span> </a></li>
                    <li><a href="index.php?page=manage_category" title=""><i class="fa fa-book"></i><span>Manage Category</span> </a></li>
                    <li><a href="index.php?page=epaper_users" title=""><i class="fa fa-book"></i><span>Users</span> </a></li>
                    

                </ul>
            </li>
             <!--<li class="menu-toggle"><a href="#" title="" class="">
                    <i class="glyphicon glyphicon-book"></i>
                    <span class="text">NayaCity ePaper</span>
                    <i class="fa fa-caret-right pull-right"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="index.php?page=epaper-new-pdf" title=""><i class="fa fa-book"></i><span>Manage Epaper</span> </a></li>
                    <li><a href="index.php?page=manage_new_category" title=""><i class="fa fa-book"></i><span>Manage Category</span> </a></li>

                </ul>
            </li>-->
            
           <li class="menu-toggle"><a href="#" title="" class="">
                    <i class="glyphicon glyphicon-book"></i>
                    <span class="text">Turning ePaper</span>
                    <i class="fa fa-caret-right pull-right"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="index.php?page=epaper-turn" title=""><i class="fa fa-book"></i><span>Manage Epaper</span> </a></li>
                    <!--<li><a href="index.php?page=manage_new_category" title=""><i class="fa fa-book"></i><span>Manage Category</span> </a></li>-->

               </ul>
            </li>
            <?php endif  ?>
        
      <?php if ($previlage == 'All' || in_array(3, $arr_prev)): ?>

            <li class="menu-toggle"><a href="#" title="" class="">
                    <i class="fa fa-users pull-left"></i>
                    <span class="text">Our team</span>
                    <i class="fa fa-caret-right pull-right"></i>
                </a>
                <ul class="sub-menu">

                    <li><a href="index.php?page=profile"  title=""><i class="fa fa-user"></i> <span>Our team</span></a></li>

                    <li><a href="index.php?page=profile_cat" title=""><i class="fa fa-plus"></i> <span>Add category</span></a></li>
                </ul>
            </li>
          <?php
      endif;
          if ($previlage == 'All'):
          ?>
            <li class="menu-toggle"><a href="#" title="" class="">
                    <i class="fa fa-user pull-left"></i>
                    <span class="text">Users</span>
                    <i class="fa fa-caret-right pull-right"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="index.php?page=user" title=""><i class="fa fa-user"></i> <span>All Users</span></a></li>
                     <li><a href="index.php?page=users" title=""><i class="fa fa-user"></i> <span>Front Users</span></a></li>
                    
                    </ul>
            </li>
          <?php endif;
  
        if ($previlage == 'All'):
          ?>
            
            <li class="menu-toggle"><a href="#" title="" class="">
                <i class="fa fa-cogs pull-left"></i>
                <span class="text">Setting</span>
                <i class="fa fa-caret-right pull-right"></i>
            </a>
            <ul class="sub-menu">
              <?php
                $res_pages=$obj->db->query("select * from p01pages where cat01id IN(1,2,3)");
                while($row_pages = $res_pages->fetch()):
                 echo '<li><a href="index.php?page=about-company&id='.$row_pages['cat01id'].'" title=""><i class="fa fa-book"></i> <span>'.$row_pages['cat01category'].'</span></a></li>';
                endwhile;
               ?>
               <li><a href="index.php?page=subscribe&id=1" title=""><i class="fa fa-book"></i> <span>Subscribe</span></a></li>
                <!--<li><a href="index.php?page=markating" title=""><i class="fa fa-book"></i> <span>Advertiesment</span></a></li>-->
                  <li><a href="index.php?page=plugin-chooser" title=""><i class="fa fa-book"></i> <span>Share Plugin</span></a></li>

                
                
            </ul>
        </li>
         <li class="menu-toggle"><a href="#" title="" class="">
                    <i class="fa fa-eye pull-left"></i>
                    <span class="text">Site Setting</span>
                    <i class="fa fa-caret-right pull-right"></i>
                </a>
                <ul class="sub-menu">
                    <li><a href="?page=site-setting&id=1" title=""><i class="fa fa-eye"></i> <span> Site Setting</span></a></li>

                </ul>
            </li>
        <?php endif; ?>  
       
         <li class="sidebar-toggle"><a href="#" title=""><i class="fa fa-toggle-left pull-left fa-toggle-right"></i> <span class="text">Collapse Menu</span></a></li>
    </ul>
</div>