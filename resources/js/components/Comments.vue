<template>
    <div class="text-blue-900">
        <!-- <div v-for="comment in comments" :key="comment.id">
            {{comment.comment}}
        </div> -->
        <div v-for="comment in comments" :key="comment.id">
            <div class="flex py-2 px-2" >
                <div>
                    <img src="/images/avatar.png" width="40" alt="">
                </div>
                <div class="ml-2 w-100">
                    <h6 class="mb-0 text-blue-800">John Lecturer | <small>10 days ago</small> </h6>
                    <p class="mt-2">
                        {{comment.comment}}
                    </p>
                </div>
            </div>
            <hr class="mt-0 mb-1">
        </div>
        <form action="" @submit.prevent="submitComment" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <textarea name="comment" class="form-control" id="comment" cols="30" rows="5" v-model="comment"></textarea>
            </div>
            <div>
                <div class="flex justify-between py-2 px-2 rounded d-none" id="fileContainer" style="border: 1px solid #abaeba;">
                    <div class="flex">
                        <div class="extImgContainer"></div>
                        <div class="ml-4 w-100">
                            <span class="docName">Doc.name</span>
                        </div>
                    </div>
                    <div class="mt-1" id="remove" data-toggle="tooltip" data-placement="top" title="Remove file">
                        <span>
                            <i class="fa fa-times" aria-hidden="true"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="flex justify-between mt-3">
                <div class="box" data-toggle="tooltip" data-placement="top" title="Attach file">
                    <input type="file" name="file" id="file" class="projectFile inputfile-3" data-multiple-caption="{count} files selected" multiple="" aria-describedby="file">
                    <label class="flex justify-center transition-all duration-200 ease-in-out" for="file"> <i class="fas fa-paperclip"></i> </label>
                </div>
                <button type="submit" class="btn btn-outline-primary" id="btn-comment">Add Comment</button>
            </div>
            <!-- <button type="submit" class="btn btn-outline-primary">Add Comment</button> -->
        </form>
    </div>
</template>
<script>
export default {
    props: ['project', 'user'],
    mounted() {
        axios.get('/comments/show')
            .then(response => {
                console.log(response.data)
                this.comments = response.data
            })
            .catch(function(error) {
                console.log(error);
            });
            // console.log(this.project[0].project_id);
            // console.log(this.user);

    },

    data() {
        return {
            comments: [],
            comment: '',
            user_id: this.user,
            project_id: this.project[0].project_id,
            file: ''
        }
    },
    methods: {
        submitComment() {
            axios.post('/comments/post', {
                comment: this.comment,
                user_id: this.user_id,
                project_id: this.project[0].project_id,
            })
                .then(response => {
                    console.log(response.data)
                    this.comments.push(response.data)

                })
                .catch(function(error) {
                    console.log(error);
                })
        },
    }
}
</script>