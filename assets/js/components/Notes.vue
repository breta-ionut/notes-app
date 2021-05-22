<script src="./Notes.js"></script>

<template>
    <div class="container mt-xxl-5" v-if="areNotesLoaded">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Name</th>
                    <th scope="col">Content</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>

            <tbody v-for="note in notes">
                <tr>
                    <td>{{ note.getName() }}</td>
                    <td>{{ note.getContent() }}</td>
                    <td>
                        <button class="btn btn-sm btn-primary" @click="edit(note)">Edit</button>
                        <button class="btn btn-sm btn-danger" @click="remove(note)">Delete</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <slot v-if="currentNote">
            <NoteModal :note="currentNote" @close="reset" />
        </slot>

        <button class="btn btn-primary" @click="add">Add</button>
    </div>
</template>
