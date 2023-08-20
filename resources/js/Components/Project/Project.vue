<script setup>
import EditorJS from '@editorjs/editorjs';
import Table from '@editorjs/table';
import { onMounted } from 'vue';


</script>
<template>
    {{ saved }}
    <button @click='saveEditor()'>
        save
    </button>
    <div id='editorjs'>
    </div>
</template>

<style></style>
<script>
export default {
    data() {
        return {
            editor: null,
            saved: null
        }
    },
    methods: {
        saveEditor() {
            this.editor.save().then((outputData) => {
                this.saved = outputData.blocks
            }).catch((error) => {
                console.log('Saving failed: ', error)
            });
        },
    },
    mounted() {
        this.editor = new EditorJS({
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
                blocks:[
                    {
                        "type": "table",
                        "data": {
                            "withHeadings": true,
                            "content": [["Kine", "Pigs", "Chicken"], ["1 pcs", "3 pcs", "12 pcs"], ["100$", "200$", "150$"]]
                        }
                    }
                ],
            }
        })
    }
}
</script>