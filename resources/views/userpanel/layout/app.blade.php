<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Forum - Responsive HTML5 Template</title>
    <meta name="keywords" content="HTML5 Template">
    <meta name="description" content="Forum - Responsive HTML5 Template">
    <meta name="author" content="Forum">
    <link rel="shortcut icon" href="favicon/favicon.ico">

    <meta name="format-detection" content="telephone=no">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{asset('usertemplate/build/css/style.css')}}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	<script src="https://cdn.tailwindcss.com"></script>
    
    <style>
        .fix-left {
            top: 0;
            bottom: 0;
            width: 100%;
        }
        /* .fix-right {
            position: relative;
        } */
        
        .vertical-scrollable {
            position: sticky;
            top: 10px;
            width: 100%;
        }
    </style>
</head>

<body>
    <!-- header -->
    <nav class="panel-menu" id="mobile-menu">
        <ul>

        </ul>
        <div class="mm-navbtn-names">
            <div class="mm-closebtn">
                Close
                <div class="tt-icon">
                    <svg>
                        <use xlink:href="#icon-cancel"></use>
                    </svg>
                </div>
            </div>
            <div class="mm-backbtn">Back</div>
        </div>
    </nav>
    <header id="tt-header">
        <div class="container">
            <div class="row tt-row no-gutters">
                <div class="col-auto">
                    <!-- toggle mobile menu -->
                    <a class="toggle-mobile-menu" href="#">
                        <svg class="tt-icon">
                            <use xlink:href="#icon-menu_icon"></use>
                        </svg>
                    </a>
                    <!-- /toggle mobile menu -->
                    <!-- logo -->
                    <div class="tt-logo">
                        <a href="index.html"><img src="images/logo.png" alt=""></a>
                    </div>
                    <!-- /logo -->
                    <!-- desctop menu -->
                    <div class="tt-desktop-menu">
                        <nav>
                            <ul>
                                <li><a href="home.html"><span>Home</span></a></li>
                                <li><a href="user_event.html"><span>Events</span></a></li>
                                <li><a href="topic_create.html"><span>Create</span></a></li>
                            </ul>
                        </nav>
                    </div>
                    <!-- /desctop menu -->
                    <!-- tt-search -->
                    <div class="tt-search">
                        <!-- toggle -->
                        <button class="tt-search-toggle" data-toggle="modal" data-target="#modalAdvancedSearch">
                            <svg class="tt-icon">
                                <use xlink:href="#icon-search"></use>
                            </svg>
                        </button>
                        <!-- /toggle -->
                        <form class="search-wrapper">
                            <div class="search-form">
                                <input type="text" class="tt-search__input" placeholder="Search">
                                <button class="tt-search__btn" type="submit">
                                    <svg class="tt-icon">
                                        <use xlink:href="#icon-search"></use>
                                    </svg>
                                </button>
                                <button class="tt-search__close">
                                    <svg class="tt-icon">
                                        <use xlink:href="#cancel"></use>
                                    </svg>
                                </button>
                            </div>
                            <div class="search-results">
                                <div class="tt-search-scroll">
                                    <ul>
                                        <li>
                                            <a href="page-single-topic.html">
                                                <h6 class="tt-title">Rdr2 secret easter eggs</h6>
                                                <div class="tt-description">
                                                    Here’s what I’ve found in Red Dead Redem..
                                                </div>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                                <button type="button" class="tt-view-all" data-toggle="modal" data-target="#modalAdvancedSearch">Advanced Search</button>
                            </div>
                        </form>
                    </div>
                    <!-- /tt-search -->
                </div>
                <div class="col-auto ml-auto">
                    <div class="tt-user-info d-flex justify-content-center">
                        <a href="user_activity.html" class="tt-btn-icon">
                            <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-notification"></use>
                                </svg></i>
                        </a>
                        <div class="tt-avatar-icon tt-size-md">
                            <a href="profile_user.html" class="tt-btn-icon">
                                <i class="tt-icon"><svg>
                                    <use xlink:href="#icon-ava-a"></use>
                                </svg></i>
                            </a>
                        </div>
                        <!-- <div class="">
                            <p>Name</p>
                        </div> -->
                        <div class="custom-select-01" id="js-settings-btn">
                            <select disabled>
                                <option value="">User Name</option>
                            </select>
                        </div>
                        <!-- <div class="tt-col-btn tt-size-md" id="js-settings-btn">
                            <a href="#" class="tt-btn-icon">
                                <i class="tt-icon">
                                <svg class="tt-icon">
                                  <use xlink:href="#icon-settings_fill"></use>
                                </svg>
                                </i>
                            </a>
                        </div> -->
                    </div>
                </div>
            </div>
        </div>
    </header>


    <!-- account silde show -->

    <div id="js-popup-settings" class="tt-popup-settings">
        <div class="tt-btn-col-close">
            <a href="#">
                <span class="tt-icon-title">
                    <svg>
                        <use xlink:href="#icon-settings_fill"></use>
                    </svg>
                </span>
                <span class="tt-icon-text">
                    Profile
                </span>
                <span class="tt-icon-close">
                    <svg>
                        <use xlink:href="#icon-cancel"></use>
                    </svg>
                </span>
            </a>
        </div>
        <form class="form-default">
            <!-- <div class="tt-form-upload">
                <div class="row no-gutter">
                    <div class="col-auto">
                        <div class="tt-avatar">
                            <svg>
                              <use xlink:href="#icon-ava-d"></use>
                            </svg>
                        </div>
                    </div>
                    <div class="col-auto ml-auto">
                        <a href="#" class="btn btn-primary">Upload Picture</a>
                    </div>
                </div>
            </div> -->
            <div class="form-group">
                <label for="settingsUserName">Username</label>
                <input type="text" name="name" class="form-control" id="settingsUserName" placeholder="azyrusmax">
            </div>
            <div class="form-group">
                <label for="settingsUserEmail">Email</label>
                <input type="text" name="name" class="form-control" id="settingsUserEmail" placeholder="Sample@sample.com">
            </div>
            <div class="form-group">
                <label for="settingsUserPassword">Password</label>
                <input type="password" name="name" class="form-control" id="settingsUserPassword" placeholder="************">
            </div>
            <div class="form-group">
                <label for="settingsUserLocation">Department</label>
                <input type="text" name="name" class="form-control" id="settingsUserLocation" placeholder="Slovakia">
            </div>

            <!-- <div class="form-group">
                <label for="settingsUserAbout">Notify me via Email</label>
                <div class="checkbox-group">
                    <input type="checkbox" id="settingsCheckBox01" name="checkbox">
                    <label for="settingsCheckBox01">
                        <span class="check"></span>
                        <span class="box"></span>
                        <span class="tt-text">When someone replies to my thread</span>
                    </label>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="settingsCheckBox02" name="checkbox">
                    <label for="settingsCheckBox02">
                        <span class="check"></span>
                        <span class="box"></span>
                        <span class="tt-text">When someone likes my thread or reply</span>
                    </label>
                </div>
                <div class="checkbox-group">
                    <input type="checkbox" id="settingsCheckBox03" name="checkbox">
                    <label for="settingsCheckBox03">
                        <span class="check"></span>
                        <span class="box"></span>
                        <span class="tt-text">When someone mentions me</span>
                    </label>
                </div>
            </div> -->
            <div class="form-group">
                <a href="#" class="btn btn-secondary">Logout</a>
            </div>
        </form>
    </div>

    <!-- close header -->

    <main id="tt-pageContent">
        <div class="tt-custom-mobile-indent container">
            <div class="row">
                <div class="tt-categories-title col-lg-12">
                    <div class="tt-title">Lastest</div>
                </div>
                <div class="col-lg-3 tt-categories-list fix-left">
                    <div class="tt-item  vertical-scrollable ">
                        <form class="form-default">
                            <div class="form-group">
                                <i class="pt-customInputIcon">
                               <svg class="tt-icon">
                                  <use xlink:href="#icon-search"></use>
                                </svg>
                            </i>
                                <input type="text" name="name" class="form-control pt-customInputSearch" id="searchForum" placeholder="Search ">
                            </div>
                            <!-- <div class="form-group">
                                <label for="searchName">Posted by</label>
                                <input type="text" name="name" class="form-control" id="searchName" placeholder="Username">
                            </div> -->
                            <!-- <div class="form-group">
                                <label for="searchCategory">In Category</label>
                                <input type="text" name="name" class="form-control" id="searchCategory" placeholder="Add Category">
                            </div> -->
                            <!-- <div class="checkbox-group">
                                <input type="checkbox" id="searcCheckBox01" name="checkbox">
                                <label for="searcCheckBox01">
                                <span class="check"></span>
                                <span class="box"></span>
                                <span class="tt-text">Include all tags</span>
                            </label>
                            </div> -->
                            <div class="form-group">
                                <label>Only return topics/posts that...</label>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="searcCheckBox02" name="checkbox">
                                    <label for="searcCheckBox02">
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    <span class="tt-text">I liked</span>
                                </label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="searcCheckBox03" name="checkbox">
                                    <label for="searcCheckBox03">
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    <span class="tt-text">are in my messages</span>
                                </label>
                                </div>
                                <div class="checkbox-group">
                                    <input type="checkbox" id="searcCheckBox04" name="checkbox">
                                    <label for="searcCheckBox04">
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    <span class="tt-text">I’ve read</span>
                                </label>
                                </div>
                            </div>
                            <!-- <div class="form-group">
                                <select class="form-control" id="searchTop">
                                <option>any</option>
                                <option>value 01</option>
                                <option>value 02</option>
                                <option>value 03</option>
                            </select>
                            </div> -->
                            <div class="form-group">
                                <label for="searchaTopics">Categories</label>
                                <select class="form-control" id="searchaTopics">
                                <option>any</option>
                                <option>value 01</option>
                                <option>value 02</option>
                                <option>value 03</option>
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="searchAdvTime">Posted</label>
                                <div class="row">
                                    <div class="col-6">
                                        <input type="text" name="name" class="form-control" id="searchAdvTime" placeholder="dd-mm-yyyy">
                                    </div>
                                    <div class="col-6">
                                        <input type="text" name="name" class="form-control" id="searchAdvTime" placeholder="dd-mm-yyyy">
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="searchaTopics">Event</label>
                                <select class="form-control" id="searchaTopics">
                                <option>any</option>
                                <option>value 01</option>
                                <option>value 02</option>
                                <option>value 03</option>
                            </select>
                            </div>
                            <div class="form-group">
                                <label for="minPostCount">Department</label>
                                <select class="form-control" id="minPostCount">
                                <option>1</option>
                                <option>2</option>
                                <option>3</option>
                                <option>4</option>
                                <option>5</option>
                                <option>6</option>
                                <option>7</option>
                                <option>8</option>
                                <option>9</option>
                                <option selected>10</option>
                            </select>
                            </div>
                            <div class="form-group">
                                <a href="#" class="btn btn-secondary btn-block">Search</a>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tt-categories-list col-lg-9">
                    <!-- <div class="tt-categories-title col-lg-12">
                        <div class="tt-title">Lastest</div>

                    </div> -->
                    
                    @yield('content')                    

                    <div class="col-12 d-flex justify-content-end   ">
                        <div class="tt-row-btn ">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Previous">
                                            <span aria-hidden="true">&laquo;</span>
                                            <span class="sr-only">Previous</span>
                                        </a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">1</a></li>
                                    <li class="page-item"><a class="page-link" href="#">2</a></li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#" aria-label="Next">
                                            <span aria-hidden="true">&raquo;</span>
                                            <span class="sr-only">Next</span>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <!-- end pagination -->
                </div>
            </div>
        </div>
    </main>


    <!-- create icon -->
    <a href="page-create-topic.html" class="tt-btn-create-topic">
        <span class="tt-icon">
        <svg>
          <use xlink:href="#icon-create_new"></use>
        </svg>
    </span>
    </a>
    <!-- advance search -->
    <div class="modal fade" id="modalAdvancedSearch" tabindex="-1" role="dialog" aria-label="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <div class="tt-modal-advancedSearch">
                    <div class="tt-modal-title">
                        <i class="pt-icon">
						<svg>
							<use xlink:href="#icon-advanced_search"></use>
						</svg>
					</i> Advanced Search
                        <a class="pt-close-modal" href="#" data-dismiss="modal">
                            <svg class="icon">
							<use xlink:href="#icon-cancel"></use>
						</svg>
                        </a>
                    </div>
                    <form class="form-default">
                        <div class="form-group">
                            <i class="pt-customInputIcon">
                           <svg class="tt-icon">
                              <use xlink:href="#icon-search"></use>
                            </svg>
                        </i>
                            <input type="text" name="name" class="form-control pt-customInputSearch" id="searchForum" placeholder="Search all forums">
                        </div>
                        <div class="form-group">
                            <label for="searchName">Posted by</label>
                            <input type="text" name="name" class="form-control" id="searchName" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="searchCategory">In Category</label>
                            <input type="text" name="name" class="form-control" id="searchCategory" placeholder="Add Category">
                        </div>
                        <div class="checkbox-group">
                            <input type="checkbox" id="searcCheckBox01" name="checkbox">
                            <label for="searcCheckBox01">
				            <span class="check"></span>
				            <span class="box"></span>
				            <span class="tt-text">Include all tags</span>
				        </label>
                        </div>
                        <div class="form-group">
                            <label>Only return topics/posts that...</label>
                            <div class="checkbox-group">
                                <input type="checkbox" id="searcCheckBox02" name="checkbox">
                                <label for="searcCheckBox02">
					            <span class="check"></span>
					            <span class="box"></span>
					            <span class="tt-text">I liked</span>
					        </label>
                            </div>
                            <div class="checkbox-group">
                                <input type="checkbox" id="searcCheckBox03" name="checkbox">
                                <label for="searcCheckBox03">
					            <span class="check"></span>
					            <span class="box"></span>
					            <span class="tt-text">are in my messages</span>
					        </label>
                            </div>
                            <div class="checkbox-group">
                                <input type="checkbox" id="searcCheckBox04" name="checkbox">
                                <label for="searcCheckBox04">
					            <span class="check"></span>
					            <span class="box"></span>
					            <span class="tt-text">I’ve read</span>
					        </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <select class="form-control" id="searchTop">
							<option>any</option>
							<option>value 01</option>
							<option>value 02</option>
							<option>value 03</option>
						</select>
                        </div>
                        <div class="form-group">
                            <label for="searchaTopics">Where topics</label>
                            <select class="form-control" id="searchaTopics">
							<option>any</option>
							<option>value 01</option>
							<option>value 02</option>
							<option>value 03</option>
						</select>
                        </div>
                        <div class="form-group">
                            <label for="searchAdvTime">Posted</label>
                            <div class="row">
                                <div class="col-6">
                                    <select class="form-control">
									<option>any</option>
									<option>value 01</option>
									<option>value 02</option>
									<option>value 03</option>
								</select>
                                </div>
                                <div class="col-6">
                                    <input type="text" name="name" class="form-control" id="searchAdvTime" placeholder="dd-mm-yyyy">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="minPostCount">Minimum Post Count</label>
                            <select class="form-control" id="minPostCount">
							<option>1</option>
							<option>2</option>
							<option>3</option>
							<option>4</option>
							<option>5</option>
							<option>6</option>
							<option>7</option>
							<option>8</option>
							<option>9</option>
							<option selected>10</option>
						</select>
                        </div>
                        <div class="form-group">
                            <a href="#" class="btn btn-secondary btn-block">Search</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="js/bundle.js"></script>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    
    <svg width="0" height="0" class="hidden">
	 <symbol aria-hidden="true" data-prefix="fab" data-icon="facebook-f" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 264 512" id="facebook-f-brands">
    <path fill="currentColor" d="M215.8 85H264V3.6C255.7 2.5 227.1 0 193.8 0 124.3 0 76.7 42.4 76.7 120.3V192H0v91h76.7v229h94V283h73.6l11.7-91h-85.3v-62.7c0-26.3 7.3-44.3 45.1-44.3z"></path>
  </symbol>
  <symbol aria-hidden="true" data-prefix="fab" data-icon="twitter" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" id="twitter-brands">





    <path fill="currentColor" d="M459.37 151.716c.325 4.548.325 9.097.325 13.645 0 138.72-105.583 298.558-298.558 298.558-59.452 0-114.68-17.219-161.137-47.106 8.447.974 16.568 1.299 25.34 1.299 49.055 0 94.213-16.568 130.274-44.832-46.132-.975-84.792-31.188-98.112-72.772 6.498.974 12.995 1.624 19.818 1.624 9.421 0 18.843-1.3 27.614-3.573-48.081-9.747-84.143-51.98-84.143-102.985v-1.299c13.969 7.797 30.214 12.67 47.431 13.319-28.264-18.843-46.781-51.005-46.781-87.391 0-19.492 5.197-37.36 14.294-52.954 51.655 63.675 129.3 105.258 216.365 109.807-1.624-7.797-2.599-15.918-2.599-24.04 0-57.828 46.782-104.934 104.934-104.934 30.213 0 57.502 12.67 76.67 33.137 23.715-4.548 46.456-13.32 66.599-25.34-7.798 24.366-24.366 44.833-46.132 57.827 21.117-2.273 41.584-8.122 60.426-16.243-14.292 20.791-32.161 39.308-52.628 54.253z"></path>
  </symbol>
	<symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 117 117" id="icon-advanced_search"><path d="M54 108C24.22 108 0 83.78 0 54S24.22 0 54 0s54 24.22 54 54-24.22 54-54 54zm0-99C29.19 9 9 29.19 9 54s20.19 45 45 45 45-20.19 45-45S78.81 9 54 9z"></path><path d="M112.5 117c-1.15 0-2.3-.44-3.18-1.32l-23.5-23.5a4.49 4.49 0 0 1 0-6.36 4.49 4.49 0 0 1 6.36 0l23.5 23.5a4.49 4.49 0 0 1 0 6.36c-.88.88-2.03 1.32-3.18 1.32zm-40-72h-37c-2.49 0-4.5-2.01-4.5-4.5s2.01-4.5 4.5-4.5h37c2.49 0 4.5 2.01 4.5 4.5S74.99 45 72.5 45zm-14 27h-23c-2.49 0-4.5-2.01-4.5-4.5s2.01-4.5 4.5-4.5h23c2.49 0 4.5 2.01 4.5 4.5S60.99 72 58.5 72z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 81 45" id="icon-arrow_below"><path d="M40.5 45c-1.15 0-2.3-.44-3.18-1.32l-36-36a4.49 4.49 0 0 1 0-6.36 4.49 4.49 0 0 1 6.36 0L40.5 34.13 73.32 1.32a4.49 4.49 0 0 1 6.36 0 4.49 4.49 0 0 1 0 6.36l-36 36c-.88.88-2.03 1.32-3.18 1.32z" fill="#666f74"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 45 81" id="icon-arrow_left"><path d="M40.5 81c-1.15 0-2.3-.44-3.18-1.32l-36-36a4.49 4.49 0 0 1 0-6.36l36-36a4.49 4.49 0 0 1 6.36 0 4.49 4.49 0 0 1 0 6.36L10.86 40.5l32.82 32.82a4.49 4.49 0 0 1 0 6.36c-.88.88-2.03 1.32-3.18 1.32z" fill="#666f74"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-a"><circle fill="#D81159" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M90.854 98.959l-5.68-13.199h-27.44l-5.68 13.199h-10.4l25.52-56.399h8.4l25.521 56.399H90.854zM61.094 77.76h20.64l-10.32-24-10.32 24z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-b"><circle fill="#218380" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M92.375 74.799c1.785 2.4 2.68 5.334 2.68 8.801 0 4.8-1.721 8.561-5.16 11.279-3.439 2.721-8.174 4.08-14.2 4.08h-25.6V42.56h24.8c5.865 0 10.467 1.293 13.799 3.88 3.334 2.587 5 6.2 5 10.84 0 2.988-.787 5.574-2.359 7.76-1.574 2.188-3.748 3.788-6.52 4.8 3.251.907 5.771 2.559 7.56 4.959zm-32.201-8.48h13.041c7.092 0 10.639-2.64 10.639-7.92 0-2.666-.879-4.64-2.639-5.92s-4.428-1.92-8-1.92H60.174v15.76zm22.56 22.64c1.705-1.332 2.561-3.412 2.561-6.24 0-2.826-.869-4.932-2.602-6.319-1.732-1.386-4.439-2.08-8.119-2.08h-14.4v16.64h14.4c3.733-.001 6.453-.667 8.16-2.001z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-c"><circle fill="#679436" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M61.375 96.119c-4.134-2.372-7.308-5.746-9.52-10.119-2.214-4.373-3.32-9.467-3.32-15.281 0-5.812 1.106-10.892 3.32-15.239 2.212-4.346 5.386-7.706 9.52-10.08 4.132-2.373 8.972-3.56 14.52-3.56 3.785 0 7.359.587 10.721 1.76 3.359 1.174 6.186 2.827 8.479 4.96l-3.439 7.52c-2.561-2.026-5.094-3.506-7.6-4.44-2.508-.933-5.174-1.4-8-1.4-5.44 0-9.64 1.76-12.6 5.28-2.96 3.52-4.44 8.587-4.44 15.199 0 6.668 1.48 11.761 4.44 15.281 2.96 3.52 7.16 5.279 12.6 5.279 2.826 0 5.492-.467 8-1.4 2.506-.932 5.039-2.412 7.6-4.439l3.439 7.52c-2.293 2.135-5.119 3.788-8.479 4.961-3.361 1.172-6.936 1.76-10.721 1.76-5.548-.001-10.388-1.188-14.52-3.562z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-d"><circle fill="#73D2DE" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M49.254 42.56h20.8c9.227 0 16.387 2.467 21.48 7.4 5.092 4.934 7.64 11.854 7.64 20.759 0 8.908-2.548 15.841-7.64 20.801-5.094 4.96-12.254 7.439-21.48 7.439h-20.8V42.56zm20.16 48c12.96 0 19.439-6.612 19.439-19.841 0-13.172-6.479-19.759-19.439-19.759h-9.84v39.6h9.84z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-e"><circle fill="#ABD1B5" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M53.854 98.959V42.56h37.76v8.16h-27.68v15.52h26.08v8.08h-26.08v16.479h27.68v8.16h-37.76z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-f"><circle fill="#9067C6" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M54.774 98.959V42.56h36.96v8.24h-26.8v15.36h25.2v8.24h-25.2v24.56h-10.16z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-g"><circle fill="#CAC4CE" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M95.135 68.479v27.04c-2.561 1.279-5.668 2.293-9.32 3.04a55.641 55.641 0 0 1-11.16 1.12c-5.813 0-10.854-1.16-15.12-3.48-4.268-2.32-7.534-5.652-9.8-10-2.268-4.346-3.4-9.506-3.4-15.48 0-5.919 1.133-11.052 3.4-15.399 2.266-4.346 5.492-7.68 9.68-10 4.187-2.32 9.106-3.48 14.76-3.48 3.946 0 7.652.574 11.12 1.72 3.466 1.147 6.346 2.788 8.64 4.92l-3.439 7.44c-2.614-2.026-5.188-3.48-7.721-4.36s-5.319-1.32-8.36-1.32c-5.813 0-10.199 1.72-13.159 5.16-2.96 3.44-4.44 8.547-4.44 15.319 0 13.868 6.08 20.801 18.24 20.801 3.626 0 7.253-.506 10.88-1.52V75.84h-12.16v-7.36h21.359z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-h"><circle fill="#86BA90" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M85.814 42.56h10.08v56.399h-10.08v-24.48h-28.88v24.479h-10.16V42.56h10.16v23.6h28.88v-23.6z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-i"><circle fill="#DFA06E" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M66.174 98.959V42.56h10.32v56.399h-10.32z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-j"><circle fill="#FC814A" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M56.535 91.359l5.6-.4c4.746-.319 7.12-2.932 7.12-7.84V42.56h10.319v40.479c0 5.014-1.319 8.895-3.959 11.641-2.641 2.747-6.574 4.279-11.801 4.6l-6.56.4-.719-8.321z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-k"><circle fill="#564256" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M100.055 98.959H87.494l-26.16-26.24v26.24h-10.32V42.56h10.32v25.2l25.12-25.2h12.32l-27.28 27.12 28.561 29.279z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-l"><circle fill="#2E6171" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M55.214 98.959V42.56h10.32v47.92h26.319v8.479H55.214z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-m"><circle fill="#D4AFCD" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M90.734 42.56h8.08v56.399h-9.12V61.68l-14.88 28.16h-6.88l-14.96-27.76.08 36.879h-9.12V42.56h8.16l19.36 36.88 19.28-36.88z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-n"><circle fill="#7F7EFF" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M85.454 42.56h9.68v56.399h-7.76L57.134 59.6v39.359h-9.6V42.56h7.68l30.24 39.28V42.56z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-o"><circle fill="#CC8B8C" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M57.094 96.16c-4.027-2.348-7.134-5.707-9.32-10.08-2.188-4.373-3.28-9.493-3.28-15.361 0-5.866 1.08-10.972 3.24-15.319 2.16-4.346 5.266-7.692 9.32-10.04 4.053-2.346 8.826-3.52 14.321-3.52 5.492 0 10.252 1.174 14.279 3.52 4.025 2.348 7.119 5.694 9.279 10.04 2.16 4.348 3.24 9.454 3.24 15.319 0 5.868-1.094 10.988-3.279 15.361-2.188 4.373-5.295 7.732-9.32 10.08-4.027 2.347-8.76 3.52-14.199 3.52-5.495 0-10.254-1.173-14.281-3.52zm26.4-10.08c2.906-3.573 4.359-8.693 4.359-15.361 0-6.666-1.453-11.772-4.359-15.319-2.908-3.546-6.947-5.32-12.119-5.32-5.228 0-9.294 1.773-12.201 5.32-2.908 3.547-4.36 8.654-4.36 15.319 0 6.668 1.452 11.788 4.36 15.361 2.906 3.573 6.973 5.359 12.201 5.359 5.172 0 9.211-1.786 12.119-5.359z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-p"><circle fill="#598181" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M51.015 42.56h24.64c6.026 0 10.721 1.507 14.08 4.52 3.36 3.014 5.04 7.24 5.04 12.68 0 5.44-1.68 9.68-5.04 12.72-3.359 3.04-8.054 4.56-14.08 4.56h-14.32v21.92h-10.32v-56.4zm23.36 26.559c7.092 0 10.64-3.092 10.64-9.28 0-3.146-.88-5.48-2.64-7-1.761-1.52-4.428-2.28-8-2.28H61.334v18.56h13.041z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-q"><circle fill="#4B244A" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M86.814 98.92c.959.826 1.893 1.986 2.801 3.479l5.76 9.36-8.641 4.16-7.76-12.561c-1.494-2.453-4.027-3.68-7.6-3.68-5.495 0-10.254-1.173-14.281-3.52-4.027-2.348-7.134-5.707-9.32-10.08-2.188-4.373-3.28-9.493-3.28-15.361 0-5.866 1.093-10.972 3.28-15.319 2.186-4.346 5.292-7.692 9.32-10.04 4.026-2.346 8.786-3.52 14.281-3.52 5.439 0 10.172 1.174 14.199 3.52 4.025 2.348 7.133 5.694 9.32 10.04 2.186 4.348 3.279 9.454 3.279 15.319 0 6.4-1.268 11.881-3.799 16.441-2.535 4.559-6.174 7.879-10.92 9.959 1.281.376 2.401.977 3.361 1.803zm-3.32-12.84c2.906-3.573 4.359-8.693 4.359-15.361 0-6.666-1.453-11.772-4.359-15.319-2.908-3.546-6.947-5.32-12.119-5.32-5.228 0-9.294 1.773-12.201 5.32-2.908 3.547-4.36 8.654-4.36 15.319 0 6.668 1.452 11.788 4.36 15.361 2.906 3.573 6.973 5.359 12.201 5.359 5.172 0 9.211-1.786 12.119-5.359z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-r"><circle fill="#7180B9" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M96.895 98.959h-11.2l-9.681-18c-.907-1.705-2.027-2.906-3.359-3.6-1.334-.692-3.014-1.04-5.04-1.04h-7.84v22.64h-10.16V42.56h24.96c6.4 0 11.267 1.427 14.6 4.28 3.333 2.854 5 6.974 5 12.36 0 4.32-1.214 7.88-3.64 10.679-2.428 2.801-5.854 4.628-10.28 5.48 2.986.801 5.387 2.908 7.2 6.32l9.44 17.28zM81.694 66.2c1.813-1.466 2.72-3.72 2.72-6.76 0-3.092-.907-5.346-2.72-6.76-1.813-1.413-4.667-2.12-8.56-2.12h-13.44V68.4h13.44c3.893-.001 6.747-.733 8.56-2.2z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-s"><circle fill="#69747C" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M58.854 97.92c-3.788-1.173-6.987-2.826-9.6-4.961l3.44-7.52c2.72 2.08 5.586 3.6 8.6 4.561 3.013.959 6.28 1.439 9.799 1.439 3.893 0 6.894-.68 9.001-2.04 2.106-1.36 3.16-3.267 3.16-5.72 0-2.133-.975-3.76-2.921-4.881-1.947-1.119-5.188-2.186-9.72-3.199-4.693-1.013-8.507-2.187-11.44-3.52-2.934-1.333-5.147-3.041-6.64-5.121-1.494-2.08-2.24-4.72-2.24-7.92 0-3.306.906-6.266 2.72-8.88 1.813-2.613 4.372-4.653 7.68-6.12 3.306-1.466 7.12-2.2 11.44-2.2 3.945 0 7.706.6 11.279 1.8 3.573 1.2 6.507 2.84 8.801 4.92l-3.44 7.52c-5.014-4-10.56-6-16.64-6-3.628 0-6.494.733-8.6 2.2-2.108 1.468-3.16 3.508-3.16 6.12 0 2.188.933 3.868 2.8 5.04 1.866 1.174 5.04 2.268 9.52 3.28 4.747 1.068 8.601 2.254 11.561 3.56 2.96 1.308 5.226 2.975 6.8 5 1.572 2.027 2.359 4.588 2.359 7.68 0 3.36-.894 6.309-2.68 8.84-1.787 2.534-4.374 4.48-7.76 5.841-3.388 1.36-7.374 2.04-11.96 2.04-4.319.001-8.372-.587-12.159-1.759z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-t"><circle fill="#00BD9D" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M66.174 98.959V51.04h-18.4v-8.48h47.12v8.48h-18.4v47.919h-10.32z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-u"><circle fill="#F9BC64" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M53.774 93.68c-4-4-6-9.84-6-17.52v-33.6h10.08v34.159c0 4.854 1.146 8.521 3.44 11 2.292 2.48 5.653 3.721 10.081 3.721 4.372 0 7.706-1.252 10-3.76 2.292-2.506 3.439-6.16 3.439-10.961V42.56h10.08v33.6c0 7.627-2 13.453-6 17.479-4 4.027-9.84 6.04-17.52 6.04-7.733.001-13.6-1.999-17.6-5.999z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-v"><circle fill="#4A6FA5" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M90.215 42.56h10.479l-25.12 56.399h-8.4L42.054 42.56h10.64l18.72 43.601L90.215 42.56z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-w"><circle fill="#D9B26F" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M103.975 42.56h9.84l-19.92 56.399h-8.4l-14.16-40.56-14.239 40.56h-8.4L28.854 42.56h10.4l14 42 14.72-42h7.279l14.32 42.239 14.402-42.239z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-x"><circle fill="#9B6A6C" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M77.174 70.319l21.44 28.64h-12L71.334 77.84 55.975 98.959h-12l21.52-28.72-20.72-27.68h12l14.56 20.24 14.641-20.24h12l-20.802 27.76z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-y"><circle fill="#A15E49" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M99.375 42.56L76.494 72.959v26h-10.32v-26l-22.8-30.399h11.6l16.32 22.16 16.4-22.16h11.681z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 144 144" id="icon-ava-z"><circle fill="#84A2A3" cx="72" cy="72" r="72"></circle><path fill="#FFF" d="M62.614 90.719h30.001v8.24H51.094v-7.52l28.96-40.64h-28.96v-8.24h40.64V50l-29.12 40.719z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 126 108" id="icon-blockquote"><path d="M112.5 54h-27C75.6 54 72 45.93 72 40.5v-27C72 3.6 80.07 0 85.5 0h27c9.9 0 13.5 8.07 13.5 13.5v27c0 9.9-8.07 13.5-13.5 13.5z"></path><path d="M85.5 108c-2.48 0-4.5-2.02-4.5-4.5s2.02-4.5 4.5-4.5c31.14 0 31.5-30.21 31.5-31.5v-27a4.5 4.5 0 0 1 9 0v27c0 .41-.06 10.18-4.97 20.01C116.35 96.86 106.4 108 85.5 108zm-45-54h-27C3.6 54 0 45.93 0 40.5v-27C0 3.6 8.07 0 13.5 0h27C50.4 0 54 8.07 54 13.5v27C54 50.4 45.93 54 40.5 54z"></path><path d="M13.5 108c-2.48 0-4.5-2.02-4.5-4.5s2.02-4.5 4.5-4.5C44.64 99 45 68.79 45 67.5v-27c0-2.49 2.01-4.5 4.5-4.5s4.5 2.01 4.5 4.5v27c0 .41-.06 10.18-4.97 20.01C44.35 96.86 34.4 108 13.5 108z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 90 117" id="icon-bold"><path d="M58.5 117h-45a4.5 4.5 0 0 1-4.5-4.5V4.5C9 2.02 11.02 0 13.5 0h45C75.87 0 90 14.13 90 31.5c0 11.44-6.14 21.48-15.29 27C83.86 64.02 90 74.06 90 85.5c0 17.37-14.13 31.5-31.5 31.5zM18 108h40.5C70.91 108 81 97.91 81 85.5S70.91 63 58.5 63h-18c-2.49 0-4.5-2.01-4.5-4.5s2.01-4.5 4.5-4.5h18C70.91 54 81 43.91 81 31.5S70.91 9 58.5 9H18v99z"></path><path d="M13.5 9h-9a4.5 4.5 0 0 1 0-9h9C15.98 0 18 2.02 18 4.5S15.98 9 13.5 9zm0 108h-9a4.5 4.5 0 0 1 0-9h9a4.5 4.5 0 0 1 0 9z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 112.5 108" id="icon-bullet_list"><circle cx="9" cy="9" r="9"></circle><path d="M108 13.5H36a4.5 4.5 0 0 1 0-9h72a4.5 4.5 0 0 1 0 9z"></path><circle cx="9" cy="54" r="9"></circle><path d="M90 58.5H36c-2.49 0-4.5-2.01-4.5-4.5s2.01-4.5 4.5-4.5h54c2.49 0 4.5 2.01 4.5 4.5s-2.01 4.5-4.5 4.5z"></path><circle cx="9" cy="99" r="9"></circle><path d="M108 103.5H36c-2.49 0-4.5-2.01-4.5-4.5s2.01-4.5 4.5-4.5h72c2.49 0 4.5 2.01 4.5 4.5s-2.01 4.5-4.5 4.5z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 81 81" id="icon-cancel"><path d="M76.5 81c-1.15 0-2.3-.44-3.18-1.32l-72-72a4.49 4.49 0 0 1 0-6.36 4.49 4.49 0 0 1 6.36 0l72 72a4.49 4.49 0 0 1 0 6.36c-.88.88-2.03 1.32-3.18 1.32z"></path><path d="M4.5 81c-1.15 0-2.3-.44-3.18-1.32a4.49 4.49 0 0 1 0-6.36l72-72a4.49 4.49 0 0 1 6.36 0 4.49 4.49 0 0 1 0 6.36l-72 72C6.8 80.56 5.65 81 4.5 81z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.9 122.79" id="icon-color_picker"><path d="M67.61 36.38a5.003 5.003 0 0 1 0-7.07l25.1-25.1c5.75-5.75 14.91-5.59 20.86.35l4.95 4.95c5.85 5.85 5.85 15.36 0 21.21L93.77 55.48c-.98.98-2.26 1.46-3.54 1.46s-2.56-.49-3.54-1.46"></path><path d="M96.6 62.81c-1.15 0-2.31-.44-3.18-1.32L61.59 29.67a4.49 4.49 0 0 1 0-6.36 4.49 4.49 0 0 1 6.36 0l31.82 31.82a4.49 4.49 0 0 1 0 6.36c-.87.88-2.02 1.32-3.17 1.32z"></path><path d="M34.82 113.72H18.36l-9-9V88.26l58.59-58.59a4.49 4.49 0 0 1 6.36 0 4.49 4.49 0 0 1 0 6.36L18.36 91.99v9l3.73 3.73h9l55.96-55.96a4.49 4.49 0 0 1 6.36 0 4.49 4.49 0 0 1 0 6.36l-58.59 58.6z"></path><path d="M6.5 122.79a6.53 6.53 0 0 1-4.6-1.9 6.494 6.494 0 0 1 0-9.19l8.51-8.51a6.494 6.494 0 0 1 9.19 0 6.494 6.494 0 0 1 0 9.19l-8.51 8.51a6.49 6.49 0 0 1-4.59 1.9z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 161.51 161.51" id="icon-create_new"><circle cx="80.76" cy="80.76" r="80.76" fill="#3571b8"></circle><path d="M80.76 121.26c-2.49 0-4.5-2.01-4.5-4.5v-72a4.5 4.5 0 0 1 9 0v72c0 2.48-2.02 4.5-4.5 4.5z"></path><path d="M116.76 85.26h-72a4.5 4.5 0 0 1 0-9h72a4.5 4.5 0 0 1 0 9z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 111 111" id="icon-discussion"><path d="M5.5 2C3.3 2 1 3.3 1 5.5v82C1 89.7 3.3 92 5.5 92H70c2.2 0 4.81 1.36 5.81 3.32l5.38 10.49c.99 1.96 2.62 1.9 3.62-.06l5.38-10.4C91.19 93.39 93.8 92 96 92h9.5c2.2 0 3.5-2.3 3.5-4.5v-82c0-2.2-1.3-3.5-3.5-3.5H5.5z" fill="#fff"></path><path d="M83 108.65c-1.26 0-2.41-.84-3.15-2.29l-5.38-10.61C73.73 94.28 71.64 93 70 93H5.5A5.51 5.51 0 0 1 0 87.5v-82C0 2.47 2.47 0 5.5 0h100c3.03 0 5.5 2.47 5.5 5.5v82c0 3.03-2.47 5.5-5.5 5.5H96c-1.64 0-3.73 1.28-4.47 2.75l-5.38 10.62c-.74 1.45-1.89 2.28-3.15 2.28zM5.5 3A2.5 2.5 0 0 0 3 5.5v82A2.5 2.5 0 0 0 5.5 90H70c2.76 0 5.9 1.93 7.15 4.39L82.53 105c.24.47.46.63.51.66-.03-.02.19-.19.43-.66l5.38-10.62C90.1 91.93 93.24 90 96 90h9.5a2.5 2.5 0 0 0 2.5-2.5v-82a2.5 2.5 0 0 0-2.5-2.5H5.5z"></path><path d="M101 111H56c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5h45c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5zm-54 0H29c-.83 0-1.5-.67-1.5-1.5s.67-1.5 1.5-1.5h18c.83 0 1.5.67 1.5 1.5s-.67 1.5-1.5 1.5zm36-81H20c-.83 0-1.5-.67-1.5-1.5S19.17 27 20 27h63c.83 0 1.5.67 1.5 1.5S83.83 30 83 30zM65 48H20c-.83 0-1.5-.67-1.5-1.5S19.17 45 20 45h45c.83 0 1.5.67 1.5 1.5S65.83 48 65 48zm18 18H20c-.83 0-1.5-.67-1.5-1.5S19.17 63 20 63h63c.83 0 1.5.67 1.5 1.5S83.83 66 83 66z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 98 79" id="icon-dislike"><path d="M12 0h56c1.66 0 3 1.34 3 3v45c0 1.66-1.34 3-3 3h-9.73L32.16 78.08c-.57.59-1.35.92-2.16.92h-.01c-.82 0-1.6-.34-2.16-.94l-9-9.5a3 3 0 0 1-.52-3.38L25.2 51H3c-.9 0-1.75-.4-2.32-1.1-.57-.69-.8-1.61-.62-2.49l9-45C9.34 1.01 10.57 0 12 0zm74 0h9c1.66 0 3 1.34 3 3v45c0 1.66-1.34 3-3 3h-9c-1.66 0-3-1.34-3-3V3c0-1.66 1.34-3 3-3z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 135 135" id="icon-emoticon"><path d="M67.5 135C30.28 135 0 104.72 0 67.5S30.28 0 67.5 0 135 30.28 135 67.5 104.72 135 67.5 135zm0-126C35.24 9 9 35.24 9 67.5S35.24 126 67.5 126 126 99.76 126 67.5 99.76 9 67.5 9z"></path><path d="M96 63c-4.96 0-9-4.04-9-9s4.04-9 9-9 9 4.04 9 9-4.04 9-9 9zm-57 0c-4.96 0-9-4.04-9-9s4.04-9 9-9 9 4.04 9 9-4.04 9-9 9zm29.52 43c-4.67 0-8.94-.9-12.57-2.1-11.01-3.67-18.33-10.91-18.63-11.21a4.49 4.49 0 0 1 0-6.36 4.509 4.509 0 0 1 6.36-.01c.98.97 24.22 23.43 47.65.01a4.49 4.49 0 0 1 6.36 0 4.49 4.49 0 0 1 0 6.36C87.52 102.84 77.3 106 68.52 106z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 159 186" id="icon-enter"><path fill="#3471b8" d="M84 183V39l72-36v144z" opacity=".4"></path><path d="M156 150c-1.66 0-3-1.34-3-3V6H33v33c0 1.66-1.34 3-3 3s-3-1.34-3-3V3c0-1.66 1.34-3 3-3h126c1.66 0 3 1.34 3 3v144c0 1.66-1.34 3-3 3z"></path><path d="M84 186a2.995 2.995 0 0 1-3-3V39c0-1.14.64-2.17 1.66-2.68l72-36a3.01 3.01 0 0 1 4.03 1.34 3.01 3.01 0 0 1-1.34 4.03L87 40.85v137.29l67.66-33.83a3.01 3.01 0 0 1 4.03 1.34 3.01 3.01 0 0 1-1.34 4.03l-72 36c-.43.21-.89.32-1.35.32z"></path><path d="M84 150H30c-1.66 0-3-1.34-3-3v-36c0-1.66 1.34-3 3-3s3 1.34 3 3v33h51c1.66 0 3 1.34 3 3s-1.34 3-3 3zm18-27c-1.66 0-3-1.34-3-3v-18c0-1.66 1.34-3 3-3s3 1.34 3 3v18c0 1.66-1.34 3-3 3zM57 78H3c-1.66 0-3-1.34-3-3s1.34-3 3-3h54c1.66 0 3 1.34 3 3s-1.34 3-3 3z"></path><path d="M39 96c-.77 0-1.54-.29-2.12-.88a3 3 0 0 1 0-4.24L52.76 75 36.88 59.12a3 3 0 0 1 0-4.24 3 3 0 0 1 4.24 0l18 18a3 3 0 0 1 0 4.24l-18 18c-.58.59-1.35.88-2.12.88z"></path></symbol><symbol xmlns="http://www.w3.org/2000/svg" viewBox="0 0 353.07 183.57" id="icon-error_404"><style type="text/css">
	.st0{fill:#E6E6E6;}
	.st1{fill:#CCCCCC;}
	.st2{fill:#B3B3B3;}
	.st3{fill:#3471B8;}
	.st4{fill:#F2F2F2;}
	.st5{opacity:0.35;}
	.st6{opacity:0.42;}
	.st7{fill:#808080;}
	.st8{fill:#677075;}
</style>
<g>
	<path class="st0" d="M290.06,54H40.94C37.66,54,35,51.34,35,48.06V5.94C35,2.66,37.66,0,40.94,0h249.13c3.28,0,5.94,2.66,5.94,5.94
		v42.13C296,51.34,293.34,54,290.06,54z"/>
</g>
<g>
	<path class="st1" d="M62,38.5c-6.34,0-11.5-5.16-11.5-11.5S55.66,15.5,62,15.5S73.5,20.66,73.5,27S68.34,38.5,62,38.5z"/>
</g>
<g>
	<path class="st2" d="M270,20.5H89c-1.38,0-2.5-1.12-2.5-2.5s1.12-2.5,2.5-2.5h181c1.38,0,2.5,1.12,2.5,2.5S271.38,20.5,270,20.5z"
		/>
</g>
<g>
	<path class="st2" d="M143,38.5H89c-1.38,0-2.5-1.12-2.5-2.5s1.12-2.5,2.5-2.5h54c1.38,0,2.5,1.12,2.5,2.5S144.38,38.5,143,38.5z"/>
</g>
<g>
	<path class="st3" d="M255.06,118H5.94C2.66,118,0,115.34,0,112.06V69.94C0,66.66,2.66,64,5.94,64h249.13
		c3.28,0,5.94,2.66,5.94,5.94v42.13C261,115.34,258.34,118,255.06,118z"/>
</g>
<g>
	<path class="st4" d="M27,102.5c-6.34,0-11.5-5.16-11.5-11.5S20.66,79.5,27,79.5S38.5,84.66,38.5,91S33.34,102.5,27,102.5z"/>
</g>
<g>
	<g>
		<path class="st4" d="M60,84.5h-6c-1.38,0-2.5-1.12-2.5-2.5s1.12-2.5,2.5-2.5h6c1.38,0,2.5,1.12,2.5,2.5S61.38,84.5,60,84.5z"/>
	</g>
	<g>
		<path class="st4" d="M189.73,84.5h-12.16c-1.38,0-2.5-1.12-2.5-2.5s1.12-2.5,2.5-2.5h12.16c1.38,0,2.5,1.12,2.5,2.5
			S191.11,84.5,189.73,84.5z M157.3,84.5h-12.16c-1.38,0-2.5-1.12-2.5-2.5s1.12-2.5,2.5-2.5h12.16c1.38,0,2.5,1.12,2.5,2.5
			S158.68,84.5,157.3,84.5z M124.87,84.5H112.7c-1.38,0-2.5-1.12-2.5-2.5s1.12-2.5,2.5-2.5h12.16c1.38,0,2.5,1.12,2.5,2.5
			S126.25,84.5,124.87,84.5z M92.43,84.5H80.27c-1.38,0-2.5-1.12-2.5-2.5s1.12-2.5,2.5-2.5h12.16c1.38,0,2.5,1.12,2.5,2.5
			S93.81,84.5,92.43,84.5z"/>
	</g>
	<g>
		<path class="st4" d="M216,84.5h-6c-1.38,0-2.5-1.12-2.5-2.5s1.12-2.5,2.5-2.5h6c1.38,0,2.5,1.12,2.5,2.5S217.38,84.5,216,84.5z"/>
	</g>
</g>
<g class="st5">
	<path class="st4" d="M134,102.5h-16c-1.38,0-2.5-1.12-2.5-2.5s1.12-2.5,2.5-2.5h16c1.38,0,2.5,1.12,2.5,2.5S135.38,102.5,134,102.5
		z M102,102.5H86c-1.38,0-2.5-1.12-2.5-2.5s1.12-2.5,2.5-2.5h16c1.38,0,2.5,1.12,2.5,2.5S103.38,102.5,102,102.5z M70,102.5H54
		c-1.38,0-2.5-1.12-2.5-2.5s1.12-2.5,2.5-2.5h16c1.38,0,2.5,1.12,2.5,2.5S71.38,102.5,70,102.5z"/>
</g>
<g>
	<path class="st0" d="M290.06,181H40.94c-3.28,0-5.94-2.66-5.94-5.94v-42.13c0-3.28,2.66-5.94,5.94-5.94h249.13
		c3.28,0,5.94,2.66,5.94,5.94v42.13C296,178.34,293.34,181,290.06,181z"/>
</g>
<g>
	<path class="st1" d="M62,165.5c-6.34,0-11.5-5.16-11.5-11.5s5.16-11.5,11.5-11.5s11.5,5.16,11.5,11.5S68.34,165.5,62,165.5z"/>
</g>
<g>
	<path class="st2" d="M224,147.5H89c-1.38,0-2.5-1.12-2.5-2.5s1.12-2.5,2.5-2.5h135c1.38,0,2.5,1.12,2.5,2.5S225.38,147.5,224,147.5
		z"/>
</g>
<g>
	<path class="st2" d="M152,165.5H89c-1.38,0-2.5-1.12-2.5-2.5s1.12-2.5,2.5-2.5h63c1.38,0,2.5,1.12,2.5,2.5S153.38,165.5,152,165.5z
		"/>
</g>
<g class="st6">
	<path class="st7" d="M276.02,166.51c-15.37,0-30.74-5.85-42.44-17.55c-23.4-23.4-23.4-61.48,0-84.88c23.4-23.4,61.48-23.4,84.88,0
		l0,0c23.4,23.4,23.4,61.48,0,84.88C306.76,160.66,291.39,166.51,276.02,166.51z M276.02,50.53c-14.35,0-28.69,5.46-39.61,16.38
		c-21.84,21.84-21.84,57.38,0,79.22c21.84,21.84,57.38,21.84,79.22,0c21.84-21.84,21.84-57.38,0-79.22
		C304.71,55.99,290.36,50.53,276.02,50.53z"/>
</g>
<g>
	<circle class="st4" cx="276.02" cy="106.52" r="36"/>
	<path class="st8" d="M276.02,145.52c-10.42,0-20.21-4.06-27.58-11.42s-11.42-17.16-11.42-27.58c0-10.42,4.06-20.21,11.42-27.58
		c7.37-7.37,17.16-11.42,27.58-11.42c10.42,0,20.21,4.06,27.58,11.42l0,0l0,0c7.37,7.37,11.42,17.16,11.42,27.58
		c0,10.42-4.06,20.21-11.42,27.58C296.23,141.46,286.44,145.52,276.02,145.52z M276.02,73.52c-8.81,0-17.1,3.43-23.33,9.67
		c-6.23,6.23-9.67,14.52-9.67,23.33c0,8.82,3.43,17.1,9.67,23.33c6.23,6.23,14.52,9.67,23.33,9.67c8.82,0,17.1-3.43,23.33-9.67
		s9.67-14.52,9.67-23.33c0-8.81-3.43-17.1-9.67-23.33l0,0C293.12,76.95,284.83,73.52,276.02,73.52z"/>
</g>
<g>
	<path class="st8" d="M301.48,143.97c-3.07,0-6.15-1.17-8.49-3.51c-1.17-1.17-1.17-3.07,0-4.24c1.17-1.17,3.07-1.17,4.24,0
		c2.34,2.34,6.15,2.34,8.49,0c2.34-2.34,2.34-6.15,0-8.49c-1.17-1.17-1.17-3.07,0-4.24c1.17-1.17,3.07-1.17,4.24,0
		c4.68,4.68,4.68,12.29,0,16.97C307.62,142.8,304.55,143.97,301.48,143.97z"/>
</g>
<g>
	<path class="st8" d="M341.07,183.57c-3.07,0-6.15-1.17-8.48-3.51l-18.38-18.38c-4.68-4.68-4.68-12.29,0-16.97
		c4.68-4.68,12.29-4.68,16.97,0l18.38,18.38c4.68,4.68,4.68,12.29,0,16.97C347.22,182.4,344.15,183.57,341.07,183.57z
		 M322.69,147.19c-1.54,0-3.07,0.58-4.24,1.75c-2.34,2.34-2.34,6.15,0,8.49l18.38,18.38c2.34,2.34,6.15,2.34,8.49,0
		c2.34-2.34,2.34-6.15,0-8.49l-18.38-18.38C325.76,147.78,324.22,147.19,322.69,147.19z"/>
</g>
<g>
	<path class="st8" d="M316.32,149.82c-0.77,0-1.54-0.29-2.12-0.88l-8.49-8.49c-1.17-1.17-1.17-3.07,0-4.24
		c1.17-1.17,3.07-1.17,4.24,0l8.49,8.49c1.17,1.17,1.17,3.07,0,4.24C317.86,149.53,317.09,149.82,316.32,149.82z"/>
</g>
<g>
	<path class="st8" d="M339.66,173.16c-0.77,0-1.54-0.29-2.12-0.88c-1.17-1.17-1.17-3.07,0-4.24l6.36-6.36
		c1.17-1.17,3.07-1.17,4.24,0c1.17,1.17,1.17,3.07,0,4.24l-6.36,6.36C341.19,172.87,340.43,173.16,339.66,173.16z"/>
</g>
</body>

</html>