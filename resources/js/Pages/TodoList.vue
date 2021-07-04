<template>
    <div class="container p-5">
        <div class="row">

            <div class="alert alert-warning alert-dismissible fade show" role="alert" v-if="$page.props.tasks_overflow">
                <strong>Whoops!</strong> {{ $page.props.tasks_overflow }}
            </div>

            <div class="col">
                <h2>Todo Application</h2>
            </div>
            <div class="col text-end">
                <inertia-link :href="route('createTaskView')"><button class="btn btn-success me-1">Add New</button></inertia-link>
                <button title="Refresh" @click="fetchTodos()" class="btn btn-warning"><i class="lni lni-spinner-arrow"></i></button>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h6>Todo List</h6>
                    </div>
                    <div class="col text-end" v-if="tasks && tasks.data && tasks.data.length">
                        <h6>Showing results from {{ tasks.from }} to {{ tasks.to }}</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div v-if="tasks && tasks.data && tasks.data.length">
                    <table class="table table-hover text-center">
                        <thead>
                            <tr>
                                <th scope="col">Icon</th>
                                <th scope="col">Title</th>
                                <th scope="col">Status</th>
                                <th scope="col">Since</th>
                                <th scope="col">Completed At</th>
                                <th scope="col">Priority</th>
                                <th scope="col">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="task in tasks.data" :key="task.id">
                                <td><img :src="task.image" class="rounded-circle" width="40"></td>
                                <td width="25%"><b>{{ task.title }}</b></td>
                                <td>
                                    <span class="badge" :class="(task.status == 'Completed') ? 'bg-success' : 'bg-warning'">{{ task.status }}</span>
                                </td>
                                <td>{{ task.created_date }}</td>
                                <td>{{ (task.completed_date != "") ? task.completed_date : "--" }}</td>
                                <td>
                                    <span class="badge" :class="(task.priority == 'High') ? 'bg-danger' : 'bg-primary'">{{ task.priority }}</span>
                                </td>
                                <td>
                                    <inertia-link title="Edit" :href="route('editTaskView', { 'id' : task.id })"><button class="btn btn-sm btn-warning me-1"><i class="lni lni-pencil"></i></button></inertia-link>
                                    <button title="Mark As Completed" @click="changeStatus(task.id, 'Completed')" v-if="task.status != 'Completed'" class="btn btn-sm btn-success"><i class="lni lni-checkmark"></i></button>
                                    <button title="Mark As Not Started" @click="changeStatus(task.id, 'Not Started')" v-else class="btn btn-sm btn-dark"><i class="lni lni-close"></i></button>
                                    <button title="Delete" class="btn btn-sm btn-danger ms-1" @click="deleteTask(task.id)"><i class="lni lni-trash-can"></i></button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="row">
                        <div class="col">
                            <button v-if="tasks.prev_page_url" @click="fetchTodos(tasks.current_page - 1)" class="btn btn-primary"><i class="lni lni-chevron-left"></i> Previous</button>
                        </div>
                        <div class="col text-end">
                            <button v-if="tasks.next_page_url" @click="fetchTodos(tasks.current_page + 1)" class="btn btn-primary">Next <i class="lni lni-chevron-right"></i></button>
                        </div>
                    </div>
                </div>
                <div v-else class="text-center p-5 m-5">
                    <img src="https://www.svgrepo.com/show/189280/tasks-tick.svg" alt="Nothing Pending" width="100">
                    <h4 class="mt-3">All Done!</h4>
                </div>
            </div>
        </div>
    </div>
</template>

<script>

export default ({
    data() {
        return {
            tasks : ""
        }
    },

    mounted () {
        this.fetchTodos();
    },

    methods : {
        fetchTodos : function (page = 1) {
            let _this = this;

            var config = {
                method: 'get',
                url: route("fetch", {"page" : page})
            };

            axios(config)
            .then(function (response) {
                _this.tasks = response.data.tasks;
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        
        changeStatus : function (id, status) {
            let _this = this;

            let data = new FormData();
            data.append("id", id);
            data.append("status", status);

            var config = {
                method: 'post',
                url: route("changeStatus"),
                data: data
            };

            axios(config)
            .then(function () {
                _this.fetchTodos(_this.tasks.current_page);
            })
            .catch(function (error) {
                console.log(error);
            });
        },
        
        deleteTask : function (id) {
            let _this = this;

            let data = new FormData();
            data.append("id", id);

            var config = {
                method: 'post',
                url: route("deleteTask"),
                data: data
            };

            axios(config)
            .then(function () {
                _this.fetchTodos(_this.tasks.current_page);
            })
            .catch(function (error) {
                console.log(error);
            });
        },
    }
})

</script>