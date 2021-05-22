<script src="./Notes.js"></script>

<template>
    <div class="container mt-xxl-5" v-if="areNotesLoaded">
        <table class="table" v-if="notes.length">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Content</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <tbody v-for="note in notes">
                <tr>
                    <td>{{ truncate(note.getName(), 25) }}</td>
                    <td>{{ truncate(note.getContent(), 50) }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary mx-2" @click="edit(note)">Edit</button>
                        <button class="btn btn-sm btn-danger mx-2" @click="remove(note)">Delete</button>
                        <button class="btn btn-sm btn-success mx-2" @click="view(note)">View</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="alert alert-primary" v-if="!notes.length">
            You don't have any notes added.
        </div>

        <button class="btn btn-primary" @click="add">Add</button>

        <slot v-if="currentlyEditedNote">
            <EditNoteModal :note="currentlyEditedNote" @close="reset" />
        </slot>

        <slot v-if="currentlyViewedNote">
            <ViewNoteModal :note="currentlyViewedNote" @close="reset" />
        </slot>
    </div>
</template>
