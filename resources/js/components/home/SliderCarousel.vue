<template>
    <!-- Feature Carousel Section -->
    <section id="feature_news_section" class="feature_news_section section_wrapper">
        <div class="container">   
            <div class="row">
                <div class="col-md-6">
                    <div class="feature_news_carousel">
                        <div id="featured-news-carousal" class="carousel slide" data-ride="carousel">
                            <!-- Wrapper for slides -->
                            <div class="carousel-inner" role="listbox">					    
                                <div v-if="posts.length > 0" class="item active feature_news_item">
                                    <div class="item_wrapper">
                                        <div class="item_img">
                                            <!-- <img class="img-responsive" :src="posts[0].image" alt="Chania"> -->
                                            <div :style="'width: 100%; height: 416px; background-image: url('+posts[0].image+'); background-size: 100% auto;'"></div>
                                        </div> <!--item_img-->
                                        <div class="item_title_date">
                                            <div class="news_item_title">
                                                <h2><a :href="'/post/' + posts[0].slug">{{posts[0].title}}</a></h2>
                                            </div>
                                            <div class="item_meta"><a :href="'/post/' + posts[0].slug">{{ posts[0].updated_at }},</a> by:<a href="#">{{ posts[0].author }}</a></div>
                                        </div> <!--item_title_date-->
                                    </div>	<!--item_wrapper-->
                                    <div class="item_content">{{posts[0].body}}</div>
    
                                </div><!--feature_news_item-->
    
                                <div v-if="posts.length > 1" class="item feature_news_item">
                                    <div class="item_wrapper">
                                        <div class="item_img">
                                            <div :style="'width: 100%; height: 416px; background-image: url('+posts[1].image+'); background-size: 100% auto;'"></div>
                                        </div> <!--item_img-->
                                        <div class="item_title_date">
                                            <div class="news_item_title">
                                                <h2><a :href="'/post/' + posts[1].slug">{{posts[1].title}}</a></h2>
                                            </div>
                                            <div class="item_meta"><a :href="'/post/' + posts[1].slug">{{ posts[1].updated_at }},</a> by:<a href="#">{{ posts[1].author }}</a></div>
                                        </div> <!--item_title_date-->
                                    </div>	<!--item_wrapper-->
                                    <div class="item_content">{{posts[1].body}}</div>
    
                                </div><!--feature_news_item-->
                                 
    
                                  <!-- Left and right controls -->
                                <div class="control-wrapper">
                                    <a class="left carousel-control" href="#featured-news-carousal" role="button" data-slide="prev">
                                        <i class="fa fa-chevron-left" aria-hidden="true"></i>
                                    </a>
                                    <a class="right carousel-control" href="#featured-news-carousal" role="button" data-slide="next">
                                        <i class="fa fa-chevron-right" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </div><!--carousel-inner-->
                        </div><!--carousel-->
                    </div><!--feature_news_carousel-->
                </div><!--col-md-6-->
                
                <div class="col-md-6">
                    <div class="feature_news_static">
                        <div class="row">								 
                            <div class="col-md-6" v-if="posts.length > 2">
                                <div class="feature_news_item">
                                    <div class="item active">
                                        <div class="item_wrapper">
                                            <div class="item_img">
                                                <!-- <img class="img-responsive" :src="posts[2].image" alt="Chania"> -->
                                                <div :style="'width: 100%; height: 416px; background-image: url('+posts[2].image+'); background-size: auto 100%;'"></div>
                                            </div> <!--item_img-->
                                            <div class="item_title_date">
                                                <div class="news_item_title">
                                                    <h2><a :href="'/post/' + posts[2].slug">{{posts[2].title}}</a></h2>
                                                </div>
                                                <div class="item_meta"><a :href="'/post/' + posts[2].slug">{{ posts[2].updated_at }},</a> by:<a href="#">{{ posts[2].author }}</a></div>
                                            </div><!--item_title_date-->
                                        </div> <!--item_wrapper-->
                                        <div class="item_content">{{posts[2].body}}</div>
    
                                    </div><!--item-->               			 
                                </div><!--feature_news_item-->
                            </div>
                            
                            <div class="col-md-6" v-if="posts.length > 3">
                                <div class="feature_news_item">
                                    <div class="item active">
                                        <div class="item_wrapper">
                                            <div class="item_img">
                                                <!-- <img class="img-responsive" :src="posts[3].image" alt="Chania"> -->
                                                <div :style="'width: 100%; height: 416px; background-image: url('+posts[3].image+'); background-size: auto 100%;'"></div>
                                            </div> <!--item_img-->
                                            <div class="item_title_date">
                                                <div class="news_item_title">
                                                    <h2><a :href="'/post/' + posts[3].slug">{{posts[3].title}}</a></h2>
                                                </div>
                                                <div class="item_meta"><a :href="'/post/' + posts[3].slug">{{ posts[3].updated_at }},</a> by:<a href="#">{{ posts[3].author }}</a></div>
                                            </div><!--item_title_date-->
                                        </div> <!--item_wrapper-->
                                        <div class="item_content">{{posts[3].body}}</div>
    
                                    </div><!--item-->               			 
                                </div><!--feature_news_item-->
                            </div><!--col-xs-6-->
                        </div><!--row-->
                    </div><!--feature_news_static-->
                </div><!--col-md-6-->
            </div><!--row-->
        </div><!--container-->   	
    </section><!--feature_news_section-->
</template>

<script>
    import axios from 'axios';

    export default {
        props: [],

        data() {
            return {
                posts: []
            }
        },

        mounted() {
            this.getPosts();
            console.log(this.user);
        },

        methods: {
            getPosts() {
                axios.get('/api/posts').then(resp => {
                    this.posts = resp.data.data;
                });
            }
        }
    }
</script>
