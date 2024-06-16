<template>
    <div>
        <div class="tab sitebar">
            <ul class="nav nav-tabs">
                <li class="active"><a  href="#1" data-toggle="tab">Latest</a></li>
                <li><a href="#2" data-toggle="tab">Populer</a></li>
            </ul>

            <div class="tab-content">
                <div class="tab-pane active" id="1">
                    <div class="media" v-for="rec in latestPosts">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" v-if="rec.image" :src="rec.image" alt="Generic placeholder image">
                                <img class="media-object" v-else src="/assets/img/img-single.jpg" alt="Generic placeholder image">
                            </a>
                        </div><!--media-left-->
                        <div class="media-body">
                            <h4 class="media-heading"><a :href="'/post/' + rec.slug">{{rec.title}}</a></h4>
                        </div><!--media-body-->
                    </div><!--media-->
                </div><!--tab-pane-->

                <div class="tab-pane" id="2">
                    <div class="media" v-for="rec in popularPosts">
                        <div class="media-left">
                            <a href="#">
                                <img class="media-object" v-if="rec.image" :src="rec.image" alt="Generic placeholder image">
                                <img class="media-object" v-else src="/assets/img/img-single.jpg" alt="Generic placeholder image">
                            </a>
                        </div><!--media-left-->
                        <div class="media-body">
                            <h4 class="media-heading"><a :href="'/post/' + rec.slug">{{rec.title}}</a></h4>
                        </div><!--media-body-->
                    </div><!--media-->
                </div><!--tab-pane-->
            </div><!--tab-content-->
        </div><!--tab-->

        <div class="ad">
            <img class="img-responsive" src="/assets/img/img-sitebar.jpg" alt="img" />
            <img class="img-responsive" src="/assets/img/img-sitebar.jpg" alt="img" />
            <img class="img-responsive" src="/assets/img/img-sitebar.jpg" alt="img" />
            <img class="img-responsive" src="/assets/img/img-sitebar.jpg" alt="img" />
        </div><!--ad-->
        
        <div class="ad">
            <img class="img-responsive" src="/assets/img/img-ad.jpg" alt="img" />
        </div>

        <div class="ad">
            <img class="img-responsive" src="/assets/img/img-ad2.jpg" alt="img" />
        </div>


    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: [],

        data() {
            return {
                posts: [],
                latestPosts: [],
                popularPosts: []
            }
        },

        mounted() {
            this.getPosts();
            console.log(this.user);
        },

        methods: {
            getPosts() {
                axios.get('/api/latest/posts').then(resp => {
                    this.posts = resp.data.data;
                    this.posts.map((item, indx) => {
                        if (indx < 4) {
                            this.latestPosts.push(item);
                        } else {
                            this.popularPosts.push(item);
                        }
                    })
                });
            }
        }
    }
</script>
