<script src="./ViewNoteModal.js"></script>

<template>
    <div class="modal fade show" tabindex="-1" aria-labelledby="note-modal-label" aria-modal="true" role="dialog" style="display: block">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="note-modal-label">Note</h5>
                    <button type="button" class="btn-close" aria-label="Close" @click="close"></button>
                </div>

                <div class="modal-body">
                    <h6>Name:</h6>
                    <p class="text-break">{{ note.getName() }}</p>

                    <h6>Content:</h6>
                    <p class="text-break">{{ note.getContent() }}</p>
                </div>
            </div>
        </div>
    </div>
</template>
