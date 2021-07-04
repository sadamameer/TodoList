<template>
    <div class="container p-5">
        <div class="row">
            <div class="col">
                <h2>Edit Task</h2>
            </div>
            <div class="col text-end">
                <inertia-link href="/"><button class="btn btn-primary me-1"><i class="lni lni-home"></i> View Tasks</button></inertia-link>
            </div>
        </div>
        <hr>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col">
                        <h6>Edit Form</h6>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <form @submit.prevent="update">
                    <div>
                        <label for="title">Title</label>
                        <input placeholder="e.g. Get the car from the rider" type="text" id="title" v-model="form.title" class="form-control">
                        <span class="text-danger" v-if="errors.title != ''">{{ errors.title }}</span>
                    </div>
                    <div class="mt-3">
                        <label for="priority">Priority</label>
                        <select v-model="form.priority" id="priority" class="form-control">
                            <option value="">--- Select Priority ---</option>
                            <option value="Normal">Normal</option>
                            <option value="High">High</option>
                        </select>
                        <span class="text-danger" v-if="errors.priority != ''">{{ errors.priority }}</span>
                    </div>
                    <div class="mt-3">
                        <label for="description">Description</label>
                        <textarea placeholder="Get the car from the rider and handover to car wash before starting the new ride." id="description" v-model="form.description" class="form-control"></textarea>
                        <span class="text-danger" v-if="errors.description != ''">{{ errors.description }}</span>
                    </div>
                    <hr>
                    <button class="btn w-100 btn-success"><i class="lni lni-checkmark"></i> Update</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>

export default ({
    data() {
        return {
            form : this.$inertia.form({
                "id" : this.$page.props.task.id,
                "title" : this.$page.props.task.title,
                "description" : this.$page.props.task.description,
                "priority" : this.$page.props.task.priority,
            })
        }
    },

    methods : {
        update : function () {
            this.form.post(route("createOrUpdate"));
        }
    },

    computed: {
        errors() {
            return this.$page.props.errors
        }
    },
})

</script>