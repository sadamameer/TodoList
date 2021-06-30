<template>
    <div class="container p-5">
        <div class="row">
            <div class="col">
                <h2>Todo Application</h2>
            </div>
            <div class="col text-end">
                <inertia-link href="/"><button class="btn btn-warning">Refresh</button></inertia-link>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-7">
                        <h6 class="m-0 mt-2">Todo List</h6>
                    </div>
                    <div class="col-md-5 text-end">
                        <div class="row">
                            <div class="col-8 form-group">
                                <input v-model="title" class="form-control" type="text" placeholder="What you want to do today?">
                            </div>
                            <div class="col-2 form-group">
                                <button class="btn btn-block" :class="(!updateMode) ? 'btn-primary' : 'btn-warning'" @click="createOrUpdateTask" v-html="(updateMode) ? 'Update' : 'Create'"></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-hover" v-if="tasks.length">
                    <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Title</th>
                            <th scope="col">Status</th>
                            <th scope="col">Since</th>
                            <th scope="col">Completed At</th>
                            <th scope="col">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="task in tasks" :key="task.id">
                            <td>{{ task.id }}</td>
                            <td width="25%">{{ task.title }}</td>
                            <td>
                                <span class="badge" :class="(task.status == 'Completed') ? 'bg-success' : 'bg-warning'">{{ task.status }}</span>
                            </td>
                            <td>{{ task.created_date }}</td>
                            <td>{{ task.completed_date }}</td>
                            <td>
                                <button class="btn btn-sm btn-warning" @click="edit(task.id, task.title)">Edit</button> | 
                                <button @click="changeStatus(task.id, 'Completed')" v-if="task.status != 'Completed'" class="btn btn-sm btn-success">Mark as completed</button>
                                <button @click="changeStatus(task.id, 'Not Started')" v-else class="btn btn-sm btn-danger">Mark as not started</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div v-else class="text-center p-5">
                    <h4>No Tasks Found!</h4>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default ({
    data() {
        return {
            id : "",
            title : "",
            updateMode : false,
            tasks : this.$page.props.tasks
        }
    },

    methods : {
        createOrUpdateTask : function () {
            if (!this.title) {
                alert("Please enter title.");
                return;
            }

            let _this = this;
            var data = new FormData();
            data.append('id', this.id);
            data.append('title', this.title);

            var config = {
                method: 'post',
                url: '/createOrUpdate',
                data : data
            };

            axios(config)
            .then(function (response) {
                _this.reset();
                _this.tasks = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });

        },

        changeStatus : function (id, status) {
            let _this = this;
            var data = new FormData();
            data.append('id', id);
            data.append('status', status);

            var config = {
                method: 'post',
                url: '/changeStatus',
                data : data
            };

            axios(config)
            .then(function (response) {
                _this.reset();
                _this.tasks = response.data;
            })
            .catch(function (error) {
                console.log(error);
            });

        },

        edit : function (id, title) {
            this.reset();
            this.id = id;
            this.title = title;
            this.updateMode = true;
        },

        reset : function () {
            this.id = "";
            this.title = "";
            this.status = "";
            this.updateMode = false;
        }
    }
})

</script>
