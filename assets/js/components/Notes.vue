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
                </tr>
            </tbody>
        </table>
    </div>

    <slot v-if="currentNote">
        <NoteModal :note="currentNote" />
    </slot>
</template>
