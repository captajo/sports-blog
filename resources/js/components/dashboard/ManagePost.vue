<template>
    <div>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div>
                    <div class="form-group mb-2">
                        <label for="">Title</label>
                        <input type="text" v-model="form.title" name="title" class="form-control">
                        <small v-if="error.title" style="color: red">{{error.title}}</small>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="">Select Category</label>
                        <select v-model="form.category_id" name="title" class="form-control">
                            <option value="">~ Select Category ~</option>
                            <option :value="rec.id" v-for="rec in categories">{{rec.name}}</option>
                        </select>
                        <small v-if="error.category_id" style="color: red">{{error.category_id}}</small>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="">Body</label>
                        <textarea v-model="form.body" name="title" class="form-control" rows="4"></textarea>
                        <small v-if="error.body" style="color: red">{{error.body}}</small>
                    </div>
                    <br>
                    <div class="form-group">
                        <label for="">Image (Post Thumbnail)</label>
                        <input type="file" id="documentFile" v-on:change="convertBase64()" name="image" class="form-control">
                        <small v-if="error.image" style="color: red">{{error.image}}</small>
                    </div>
                    <br>
                    <button class="btn btn-primary" v-on:click="managePost()">Submit</button>
                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        
    </div>
</template>

<script>
    import axios from 'axios';

    export default {
        props: [
            'postId',
        ],
        data() {
            return {
                categories: [
                    {
                        name: 'Baseball',
                        id: 1
                    }
                ],
                form: {
                    title: '',
                    category_id: '',
                    body: '',
                    image: ''
                },
                error: {
                    title: '',
                    category_id: '',
                    body: '',
                    image: ''
                }
            }
        },

        mounted() {
            console.log('Component mounted.');
            this.getUserFormData();

            if (this.postId) {
                this.getPostInfo();
            }
        },

        methods: {
            convertBase64() {
                var file2 = document.getElementById("documentFile");
                if (!file2.files[0]) {
                    return false;
                }
                this.error.image = '';

                // support only image types
                const imageTypes = [
                    "image/jpeg", "image/jpg", "image/png", "image/gif", "image/webp"
                ];
                if (!imageTypes.includes(file2.files[0].type)) {
                    this.error.image = 'Selected image type not supported, only .jpeg, .png, .gif, or .webp supported';
                    document.getElementById("documentFile").value = '';
                    return false;
                }

                // support only images less than 4MB
                if (file2.files[0].size > 4000000) {
                    this.error.image = 'Selected image can not be greater than 4MB';
                    document.getElementById("documentFile").value = '';
                    return false;
                }

                let filex = file2.files[0];
                var reader2 = new FileReader();
                var reader_data2 = reader2.readAsDataURL(filex);
                reader2.onload = this.addImg4;

                return true;
            },

            addImg4(imgsrcs) {
                this.form.image = imgsrcs.target.result;
            },

            getPostInfo() {
                axios.get('/api/user/posts/' + this.postId + '/edit').then(resp => {
                    let postItem = resp.data.data;
                    this.form.title = postItem.title;
                    this.form.body = postItem.body;
                    this.form.category_id = postItem.category ? postItem.category.id : '';
                });
            },

            getUserFormData() {
                axios.get('/api/user/posts/create').then(resp => {
                    this.categories = resp.data.data.categories;
                });
            },

            managePost() {
                if (this.postId) {
                    this.updatePost();
                } else {
                    this.createPost();
                }
            },

            updatePost() {
                if (!this.validateForm()) return;

                axios.put('/api/user/posts/' + this.postId, this.form).then(resp => {
                    window.location.href = '/dashboard/posts?status=updated';
                });
            },

            createPost() {
                if (!this.validateForm()) return;

                axios.post('/api/user/posts', this.form).then(resp => {
                    window.location.href = '/dashboard/posts?status=created';
                });
            },

            validateForm() {
                if (!this.form.title) {
                    this.error.title = 'Please enter a title to proceed';
                    return false;
                } else {
                    this.error.title = '';
                }

                if (!this.form.body) {
                    this.error.body = 'Please enter a body to proceed';
                    return false;
                } else {
                    this.error.body = '';
                }

                return true;
            }
        }
    }
</script>
