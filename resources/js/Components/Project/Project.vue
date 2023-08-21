<script setup lang='ts'>
import EditorJS from '@editorjs/editorjs';
import Table from '@editorjs/table';
import { reactive, onMounted } from 'vue'
import { router } from '@inertiajs/vue3'

const editor = new EditorJS({
    holder: 'editorjs',
    tools: {
        table: {
            class: Table,
            inlineToolbar: true,
            config: {
                // rows: 3,
                cols: 3,
                withHeadings: true,
            },
        },
    },
    data: {
        blocks: [
            {
                "type": "table",
                "data": {
                    "withHeadings": true,
                    "content": [["Kine", "Pigs", "Chicken"], ["1 pcs", "3 pcs", "12 pcs"], ["100$", "200$", "150$"]]
                }
            },
            {
                "id": "123",
                "type": "table",
                "data": {
                    "withHeadings": true,
                    "content": [["Kine", "Pigs", "Chicken"], ["1 pcs", "3 pcs", "12 pcs"], ["100$", "200$", "150$"]]
                }
            }
        ],
    }
})

const form = reactive({
    blocks: []
})

function saveEditor() {
    editor.save().then((outputData) => {
        form.blocks = [...form.blocks, ...outputData.blocks]
        // router.post('/api/block', this.form)
    }).catch((error) => {
        console.log('Saving failed: ', error)
    });
}

</script>
<template>
    <button @click='saveEditor()'>
        save
    </button>
    <div id='editorjs'>
    </div>
</template>

<style></style>