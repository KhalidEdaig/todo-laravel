<template>
    <div class="Container">
        <!-- Button trigger modal -->
        <button
            type="button"
            class="btn btn-primary mx-2 my-1"
            data-toggle="modal"
            :data-target="'#ModalInfo' + todo.id"
            style="width: 90px"
        >
            Details
        </button>
        <!-- Modal -->
        <div
            class="modal fade"
            :id="'ModalInfo' + todo.id"
            tabindex="-1"
            role="dialog"
            aria-labelledby="ModalInfoTitle"
            aria-hidden="true"
        >
            <div class="modal-dialog modal-dialog-centered " role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="Title">
                            Title : {{ todo.title }}
                        </h5>
                        <button
                            type="button"
                            class="close"
                            data-dismiss="modal"
                            aria-label="Close"
                        >
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="my-1">
                            <strong
                                ><span class="badge badge-dark"
                                    >#{{ todo.id }}</span
                                ></strong
                            >
                            <span>
                                created : {{ todo.created_at | formatDate }}
                                <span>by</span>
                                <strong>
                                    {{
                                        user.id == todo.creatededBy_id
                                            ? "me"
                                            : user.name
                                    }}
                                </strong>
                                <strong
                                    v-if="
                                        todo.affectedBy_id &&
                                            todoAffectedTo.id == userAuth.id
                                    "
                                >
                                    | <span>affected to</span> me
                                </strong>
                                <strong v-else-if="todo.affectedTo_id">
                                    {{
                                        todo.affectedTo_id
                                            ? " affected to " +
                                              todoAffectedTo.name +
                                              "."
                                            : ""
                                    }}
                                </strong>
                                <!-- {{-- display affected be someone or by user himself --}} -->
                                <strong
                                    v-if="
                                        todo.affectedTo_id &&
                                            todo.affectedBy_id &&
                                            todoAffectedBy.id == userAuth.id
                                    "
                                >
                                    <span>by</span> me.
                                </strong>
                                <strong
                                    v-else-if="
                                        todo.affectedTo_id &&
                                            todo.affectedBy_id &&
                                            todoAffectedBy.id != userAuth.id
                                    "
                                >
                                    <span> by</span>
                                    {{ todoAffectedBy.name + "." }}
                                </strong>
                            </span>
                        </div>
                        <div class="py-1">
                            <p>{{ todo.content }}</p>
                        </div>

                        <span class="badge badge-success ">
                            done
                        </span>
                    </div>
                    <div class="modal-footer">
                        <button
                            type="button"
                            class="btn btn-secondary"
                            data-dismiss="modal"
                        >
                            Close
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: {
        todo: Object,
        user: Object,
        userAuth: Object,
        todoAffectedBy: Object,
        todoAffectedTo: Object
    },
    data() {
        return {};
    },
    mounted() {
        console.log(this.todo);
    }
};
</script>

<style></style>
