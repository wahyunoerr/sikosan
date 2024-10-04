@extends('layouts.app')

@section('title', 'Dashboard')
@section('content')
    <div class="container-fluid dashboard-default">
        <div class="row">
            <div class="col-xxl-6 col-xl-5 col-lg-6 dash-45 box-col-40">
                <div class="card profile-greeting">
                    <div class="card-body">
                        <div class="d-sm-flex d-block justify-content-between">
                            <div class="flex-grow-1">
                                <div class="weather d-flex">
                                    <h2 class="f-w-400"> <span>28<sup><i class="fa fa-circle-o f-10"></i></sup>C </span></h2>
                                    <div class="span sun-bg"><i class="icofont icofont-sun font-primary"></i></div>
                                </div><span class="font-primary f-w-700">Sunny Day</span>
                                <p>Beautiful Sunny Day Walk</p>
                            </div>
                            <div class="badge-group">
                                <div class="badge badge-light-primary f-12"> <i class="fa fa-clock-o"></i><span
                                        id="txt"></span></div>
                            </div>
                        </div>
                        <div class="greeting-user">
                            <div class="profile-vector">
                                <ul class="dots-images">
                                    <li class="dot-small bg-info dot-1"></li>
                                    <li class="dot-medium bg-primary dot-2"></li>
                                    <li class="dot-medium bg-info dot-3"></li>
                                    <li class="semi-medium bg-primary dot-4"></li>
                                    <li class="dot-small bg-info dot-5"></li>
                                    <li class="dot-big bg-info dot-6"></li>
                                    <li class="dot-small bg-primary dot-7"></li>
                                    <li class="semi-medium bg-primary dot-8"></li>
                                    <li class="dot-big bg-info dot-9"></li>
                                </ul><img class="img-fluid" src="../assets/images/dashboard/default/profile.png"
                                    alt="">
                                <ul class="vector-image">
                                    <li> <img src="../assets/images/dashboard/default/ribbon1.png" alt=""></li>
                                    <li> <img src="../assets/images/dashboard/default/ribbon3.png" alt=""></li>
                                    <li> <img src="../assets/images/dashboard/default/ribbon4.png" alt=""></li>
                                    <li> <img src="../assets/images/dashboard/default/ribbon5.png" alt=""></li>
                                    <li> <img src="../assets/images/dashboard/default/ribbon6.png" alt=""></li>
                                    <li> <img src="../assets/images/dashboard/default/ribbon7.png" alt=""></li>
                                </ul>
                            </div>
                            <h4><a href="user-profile.html"><span>Welcome Back</span> John </a><span class="right-circle"><i
                                        class="fa fa-check-circle font-primary f-14 middle"></i></span>
                            </h4>
                            <div><span class="badge badge-primary">Your 5</span><span
                                    class="font-primary f-12 middle f-w-500 ms-2"> Task Is Pending</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-lg-6 col-md-6 box-col-25">
                <div class="card total-revenue overflow-hidden">
                    <div class="card-header">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">Total Revenue<i
                                        class="fa fa-circle"></i></p>
                                <h4>96.564%</h4>
                            </div>
                            <div class="setting-list">
                                <ul class="list-unstyled setting-option">
                                    <li>
                                        <div class="setting-light"><i class="icon-layout-grid2"></i></div>
                                    </li>
                                    <li><i class="view-html fa fa-code font-white"></i></li>
                                    <li><i class="icofont icofont-maximize full-card font-white"></i></li>
                                    <li><i class="icofont icofont-minus minimize-card font-white"></i></li>
                                    <li><i class="icofont icofont-refresh reload-card font-white"></i></li>
                                    <li><i class="icofont icofont-error close-card font-white"> </i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="revenue-chart" id="revenue-chart"></div>
                    </div>
                </div>
                <div class="card total-investment">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">Total Investment<i class="fa fa-circle">
                                    </i></p>
                                <h4>96.564%</h4>
                            </div>
                            <div class="setting-list">
                                <ul class="list-unstyled setting-option">
                                    <li>
                                        <div class="setting-light"><i class="icon-layout-grid2"></i></div>
                                    </li>
                                    <li><i class="view-html fa fa-code font-white"></i></li>
                                    <li><i class="icofont icofont-maximize full-card font-white"></i></li>
                                    <li><i class="icofont icofont-minus minimize-card font-white"></i></li>
                                    <li><i class="icofont icofont-refresh reload-card font-white"></i></li>
                                    <li><i class="icofont icofont-error close-card font-white"> </i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="progress sm-progress-bar">
                            <div class="progress-colors" role="progressbar" style="width: 100%" aria-valuenow="100"
                                aria-valuemin="0" aria-valuemax="100">
                                <div class="bg-secondary progress-1"></div>
                                <div class="bg-primary progress-2"></div>
                            </div>
                        </div>
                        <div class="bottom-progress"><span class="badge round-badge-primary font-worksans">3.56% <i
                                    class="fa fa-caret-up"></i></span><span
                                class="pull-right font-primary font-worksans f-w-700">75%</span></div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-4 col-md-6 dash-30 box-col-35">
                <div class="card our-user">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">Our Total Users<i
                                        class="fa fa-circle"></i></p>
                                <h4>96.564%</h4>
                            </div>
                            <div class="setting-list">
                                <ul class="list-unstyled setting-option">
                                    <li>
                                        <div class="setting-light"><i class="icon-layout-grid2"></i></div>
                                    </li>
                                    <li><i class="view-html fa fa-code font-white"></i></li>
                                    <li><i class="icofont icofont-maximize full-card font-white"></i></li>
                                    <li><i class="icofont icofont-minus minimize-card font-white"></i></li>
                                    <li><i class="icofont icofont-refresh reload-card font-white"></i></li>
                                    <li><i class="icofont icofont-error close-card font-white"> </i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="user-chart">
                            <div id="user-chart"></div>
                            <div class="icon-donut"><i data-feather="arrow-up-circle"></i></div>
                        </div>
                        <ul>
                            <li>
                                <p class="f-w-600 font-primary f-12">Desktop</p><span class="f-w-600">96.564%</span>
                            </li>
                            <li>
                                <p class="f-w-600 font-primary f-12">Mobile </p><span class="f-w-600">92.624%</span>
                            </li>
                            <li>
                                <p class="f-w-600 font-primary f-12">Tablet </p><span class="f-w-600">46.564%</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 box-col-30 xl-30">
                <div class="card our-earning">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">Our Total Earning<i
                                        class="fa fa-circle"> </i></p>
                                <h4>96.564%</h4>
                                <div class="setting-list">
                                    <ul class="list-unstyled setting-option">
                                        <li>
                                            <div class="setting-light"><i class="icon-layout-grid2"></i>
                                            </div>
                                        </li>
                                        <li><i class="view-html fa fa-code font-white"></i></li>
                                        <li><i class="icofont icofont-maximize full-card font-white"></i>
                                        </li>
                                        <li><i class="icofont icofont-minus minimize-card font-white"></i>
                                        </li>
                                        <li><i class="icofont icofont-refresh reload-card font-white"></i>
                                        </li>
                                        <li><i class="icofont icofont-error close-card font-white"> </i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="earning-chart">
                            <div id="earning-chart"></div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <ul class="d-sm-flex d-block">
                            <li>
                                <p class="f-w-600 font-primary f-12">Daily Earning</p><span class="f-w-600">96.564%</span>
                            </li>
                            <li>
                                <p class="f-w-600 font-primary f-12">Monthly Earning </p><span
                                    class="f-w-600">96.564%</span>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 box-col-40 xl-40">
                <div class="card appointment-detail">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">total appointment<i
                                        class="fa fa-circle"> </i></p>
                                <h4>12 meet</h4>
                            </div>
                            <div class="setting-list">
                                <ul class="list-unstyled setting-option">
                                    <li>
                                        <div class="setting-light"><i class="icon-layout-grid2"></i>
                                        </div>
                                    </li>
                                    <li><i class="view-html fa fa-code font-white"></i></li>
                                    <li><i class="icofont icofont-maximize full-card font-white"></i></li>
                                    <li><i class="icofont icofont-minus minimize-card font-white"></i>
                                    </li>
                                    <li><i class="icofont icofont-refresh reload-card font-white"></i>
                                    </li>
                                    <li><i class="icofont icofont-error close-card font-white"> </i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive theme-scrollbar">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="d-flex"><img class="img-fluid align-top circle"
                                                    src="../assets/images/dashboard/default/01.png" alt="">
                                                <div class="flex-grow-1"><a href="user-profile.html"><span>Ossim
                                                            keter</span></a>
                                                    <p class="mb-0">1 Hour</p>
                                                </div>
                                                <div class="active-status active-online"></div>
                                            </div>
                                        </td>
                                        <td>16 August </td>
                                        <td class="text-end">
                                            <button class="btn btn-primary" type="button"
                                                onclick="document.location='user-cards.html'">Pending</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex"><img class="img-fluid align-top circle"
                                                    src="../assets/images/dashboard/default/02.png" alt="">
                                                <div class="flex-grow-1"><a href="user-profile.html"><span>Venter
                                                            loren</span></a>
                                                    <p class="mb-0">Now</p>
                                                </div>
                                                <div class="active-status active-busy"></div>
                                            </div>
                                        </td>
                                        <td>21 September </td>
                                        <td class="text-end">
                                            <button class="btn btn-secondary" type="button"
                                                onclick="document.location='user-cards.html'">Done<i
                                                    class="fa fa-check-circle"></i></button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex"><img class="img-fluid align-top circle"
                                                    src="../assets/images/dashboard/default/03.png" alt="">
                                                <div class="flex-grow-1"><a href="user-profile.html"><span>Fran
                                                            loain</span></a>
                                                    <p class="mb-0">2 Day After</p>
                                                </div>
                                                <div class="active-status active-offline"></div>
                                            </div>
                                        </td>
                                        <td>06 March</td>
                                        <td class="text-end">
                                            <button class="btn btn-success" type="button"
                                                onclick="document.location='user-cards.html'">Pending</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex"><img class="img-fluid align-top circle"
                                                    src="../assets/images/dashboard/default/04.png" alt="">
                                                <div class="flex-grow-1"><a href="user-profile.html"><span>Loften
                                                            Horen</span></a>
                                                    <p class="mb-0">Day End</p>
                                                </div>
                                                <div class="active-status active-online"></div>
                                            </div>
                                        </td>
                                        <td>12 February</td>
                                        <td class="text-end">
                                            <button class="btn btn-info" type="button"
                                                onclick="document.location='user-cards.html'">Pending</button>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <div class="d-flex"><img class="img-fluid align-top circle"
                                                    src="../assets/images/dashboard/default/05.png" alt="">
                                                <div class="flex-grow-1"><a href="user-profile.html"><span>Loie
                                                            fenter</span></a>
                                                    <p class="mb-0">2 Day After</p>
                                                </div>
                                                <div class="active-status active-offline"></div>
                                            </div>
                                        </td>
                                        <td>06 March</td>
                                        <td class="text-end">
                                            <button class="btn btn-danger" type="button"
                                                onclick="document.location='user-cards.html'">Pending</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 box-col-30 xl-30">
                <div class="card use-country">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">User By Country<i
                                        class="fa fa-circle"> </i></p>
                                <h4>96.564%</h4>
                            </div>
                            <div class="setting-list">
                                <ul class="list-unstyled setting-option">
                                    <li>
                                        <div class="setting-light"><i class="icon-layout-grid2"></i>
                                        </div>
                                    </li>
                                    <li><i class="view-html fa fa-code font-white"></i></li>
                                    <li><i class="icofont icofont-maximize full-card font-white"></i></li>
                                    <li><i class="icofont icofont-minus minimize-card font-white"></i>
                                    </li>
                                    <li><i class="icofont icofont-refresh reload-card font-white"></i>
                                    </li>
                                    <li><i class="icofont icofont-error close-card font-white"> </i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="jvector-map-height" id="asia"></div>
                    </div>
                </div>
            </div>
            <div class="col-xl-12 box-col-12">
                <div class="card total-growth">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">Our Total Growth<i
                                        class="fa fa-circle"> </i></p>
                                <h4>96.564%</h4>
                            </div>
                            <div class="setting-list">
                                <ul class="list-unstyled setting-option">
                                    <li>
                                        <div class="setting-light"><i class="icon-layout-grid2"></i>
                                        </div>
                                    </li>
                                    <li><i class="view-html fa fa-code font-white"></i></li>
                                    <li><i class="icofont icofont-maximize full-card font-white"></i></li>
                                    <li><i class="icofont icofont-minus minimize-card font-white"></i>
                                    </li>
                                    <li><i class="icofont icofont-refresh reload-card font-white"></i>
                                    </li>
                                    <li><i class="icofont icofont-error close-card font-white"> </i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body pb-0">
                        <div class="growth-chart">
                            <div id="growth-chart"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 box-col-33">
                <div class="card">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">Recent Activity<i
                                        class="fa fa-circle"> </i></p>
                                <h4>New & Update</h4>
                            </div>
                            <div class="setting-list">
                                <ul class="list-unstyled setting-option">
                                    <li>
                                        <div class="setting-light"><i class="icon-layout-grid2"></i>
                                        </div>
                                    </li>
                                    <li><i class="view-html fa fa-code font-white"></i></li>
                                    <li><i class="icofont icofont-maximize full-card font-white"></i></li>
                                    <li><i class="icofont icofont-minus minimize-card font-white"></i>
                                    </li>
                                    <li><i class="icofont icofont-refresh reload-card font-white"></i>
                                    </li>
                                    <li><i class="icofont icofont-error close-card font-white"> </i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="activity-timeline">
                            <div class="d-flex">
                                <div class="activity-line"></div>
                                <div class="activity-dot-primary"></div>
                                <div class="flex-grow-1"><span class="f-w-600 d-block">Updated
                                        Product</span>
                                    <p class="mb-0">I like to be real. I don't like things to be staged
                                        or fussy.</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="activity-dot-primary"></div>
                                <div class="flex-grow-1"><span class="f-w-600 d-block">You liked James
                                        products</span>
                                    <p class="mb-0">If you have it, you can make anything look good.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="activity-dot-secondary"></div>
                                <div class="flex-grow-1"><span class="f-w-600 d-block">James just like
                                        your product</span>
                                    <p class="mb-0">I like to design everything to do with the body.</p>
                                </div><i class="fa fa-circle circle-dot-primary"></i>
                            </div>
                            <div class="d-flex">
                                <div class="activity-dot-primary"></div>
                                <div class="flex-grow-1"><span class="f-w-600 d-block">Jenna commented
                                        on your product</span>
                                    <p class="mb-0">Fashion fades, only style remain the same.</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-start">
                                <div class="activity-dot-secondary"></div>
                                <div class="flex-grow-1"><span class="f-w-600 d-block">Jihan Doe just
                                        like your product</span>
                                    <p class="mb-0">Design and style should work toward making you look
                                        good and feel good without lot of effort.</p>
                                </div><i class="fa fa-circle circle-dot-secondary"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 proorder box-col-33">
                <div class="card user-chat">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">Chat With Our Users<i
                                        class="fa fa-circle"> </i></p>
                                <h4>Chat</h4>
                            </div>
                            <div class="setting-list">
                                <ul class="list-unstyled setting-option">
                                    <li>
                                        <div class="setting-light"><i class="icon-layout-grid2"></i>
                                        </div>
                                    </li>
                                    <li><i class="view-html fa fa-code font-white"></i></li>
                                    <li><i class="icofont icofont-maximize full-card font-white"></i></li>
                                    <li><i class="icofont icofont-minus minimize-card font-white"></i>
                                    </li>
                                    <li><i class="icofont icofont-refresh reload-card font-white"></i>
                                    </li>
                                    <li><i class="icofont icofont-error close-card font-white"> </i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body chat-box">
                        <div class="d-flex left-chat">
                            <div class="flex-grow-1">
                                <div class="message-main">
                                    <p class="mb-0">Hii</p>
                                </div>
                                <div class="sub-message message-main">
                                    <p class="mb-0">Good Evening, My Friend</p>
                                </div>
                            </div>
                            <p class="f-w-500 mb-0 px-0">7:28 PM</p>
                        </div>
                        <div class="d-flex right-chat">
                            <div class="flex-grow-1 text-end">
                                <div class="message-main pull-right">
                                    <p class="text-start mb-0">What can do for you</p>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex left-chat">
                            <div class="flex-grow-1">
                                <div class="sub-message message-main mt-0">
                                    <p class="mb-0">Can i Borrow some money</p>
                                </div>
                            </div>
                        </div>
                        <div class="input-group">
                            <input class="form-control" id="mail" type="text" placeholder="Type Your Message"
                                name="text">
                            <div class="send-msg"><i data-feather="send"></i></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-6 box-col-33">
                <div class="card our-todolist">
                    <div class="card-header pb-0">
                        <div class="d-flex justify-content-between">
                            <div class="flex-grow-1">
                                <p class="square-after f-w-600 header-text-primary">Our To-Do List<i class="fa fa-circle">
                                    </i></p>
                                <h4>Todo List</h4>
                            </div>
                            <div class="setting-list">
                                <ul class="list-unstyled setting-option">
                                    <li>
                                        <div class="setting-light"><i class="icon-layout-grid2"></i>
                                        </div>
                                    </li>
                                    <li><i class="view-html fa fa-code font-white"></i></li>
                                    <li><i class="icofont icofont-maximize full-card font-white"></i></li>
                                    <li><i class="icofont icofont-minus minimize-card font-white"></i>
                                    </li>
                                    <li><i class="icofont icofont-refresh reload-card font-white"></i>
                                    </li>
                                    <li><i class="icofont icofont-error close-card font-white"> </i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="activity-timeline todo-timeline">
                            <div class="d-flex">
                                <div class="activity-line"></div>
                                <div class="activity-dot-primary"></div>
                                <div class="flex-grow-1">
                                    <p class="mt-0 todo-font"><span class="font-primary">20-04-2022
                                        </span>Today</p>
                                    <div class="d-flex mt-0"><img class="img-fluid img-30"
                                            src="../assets/images/dashboard/default/todo.png" alt="">
                                        <div class="flex-grow-1"><span class="f-w-600">New Order $2340<i
                                                    class="fa fa-circle circle-dot-primary pull-right"></i></span>
                                            <p class="mb-0">Update New Product Pdf And Delivery Product
                                            </p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="activity-dot-secondary"></div>
                                <div class="flex-grow-1">
                                    <p class="mt-0 todo-font"><span class="font-primary">20-04-2022
                                        </span>Today<span class="badge badge-primary ms-2">New</span></p>
                                    <span class="f-w-600">James just like your product<i
                                            class="fa fa-circle circle-dot-secondary pull-right"></i></span>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="activity-dot-primary"></div>
                                <div class="flex-grow-1">
                                    <p class="mt-0 todo-font"><span class="font-primary">20-04-2022
                                        </span>Today</p><span class="f-w-600">Jihan Doe just like your
                                        product</span>
                                    <p class="mb-0">Design and style should work making you look good
                                        and feel good without lot of effort.</p>
                                </div>
                            </div>
                            <div class="d-flex">
                                <div class="activity-dot-primary"></div>
                                <div class="flex-grow-1">
                                    <p class="mt-0 todo-font"><span class="font-primary">20-04-2022
                                        </span>Today</p><span class="f-w-600">Take Our Client Metting<i
                                            class="fa fa-circle circle-dot-primary pull-right"></i></span>
                                    <p class="mb-0">Hosting an effective client meeting.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@push('chart-js')
    <script src="{{ asset('assets/js/dashboard/default.js') }}"></script>
    <script src="{{ asset('assets/js/chart/chartist/chartist.js') }}"></script>
    <script src="{{ asset('assets/js/chart/chartist/chartist-plugin-tooltip.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('assets/js/chart/apex-chart/stock-prices.js') }}"></script>
@endpush
