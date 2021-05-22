<script src="./NoteModal.js"></script>

<template>
    <div class="modal fade show" tabindex="-1" aria-labelledby="note-modal-label" aria-modal="true" role="dialog" style="display: block">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="note-modal-label">Note</h5>
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form>
                        <div class="alert alert-danger" v-if="errors.global.length">
                            <p class="mb-0" v-for="error in errors.global">{{ error }}</p>
                        </div>

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>

                            <input type="text" name="name" id="name" class="form-control" :class="{'border-danger': errors.fields.name}" required maxlength="100" v-model="dirtyNote.name" />

                            <p class="form-text text-danger" v-for="error in errors.fields.name">{{ error }}</p>
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>

                            <textarea name="content" id="content" class="form-control" :class="{'border-danger': errors.fields.content}" required maxlength="1023" v-model="dirtyNote.content" />

                            <p class="form-text text-danger" v-for="error in errors.fields.content">{{ error }}</p>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" @click="close">Close</button>
                    <button type="button" class="btn btn-primary" @click="save">Save</button>
                </div>
            </div>
        </div>
    </div>
</template>
