<script setup>
import { onMounted, ref, watch } from 'vue';

const props = defineProps({
    modelValue: {
        type: String,
        default: ''
    },
    placeholder: {
        type: String,
        default: 'Saisissez votre texte ici...'
    }
});

const emit = defineEmits(['update:modelValue']);
const editorContainer = ref(null);
let quillInstance = null;
const isScriptLoaded = ref(false);

const loadQuill = () => {
    return new Promise((resolve, reject) => {
        if (window.Quill) {
            resolve();
            return;
        }

        // Load Quill CSS Snow theme
        const link = document.createElement('link');
        link.rel = 'stylesheet';
        link.href = 'https://cdn.jsdelivr.net/npm/quill@2.0.0/dist/quill.snow.css';
        document.head.appendChild(link);

        // Load Quill JS Script
        const script = document.createElement('script');
        script.src = 'https://cdn.jsdelivr.net/npm/quill@2.0.0/dist/quill.js';
        script.onload = () => {
            isScriptLoaded.value = true;
            resolve();
        };
        script.onerror = reject;
        document.head.appendChild(script);
    });
};

onMounted(async () => {
    try {
        await loadQuill();
        
        if (!editorContainer.value) return;

        // Initialize Quill with rich, premium options
        quillInstance = new window.Quill(editorContainer.value, {
            theme: 'snow',
            placeholder: props.placeholder,
            modules: {
                toolbar: [
                    [{ 'header': [1, 2, 3, false] }],
                    ['bold', 'italic', 'underline', 'strike'],
                    [{ 'list': 'ordered'}, { 'list': 'bullet' }],
                    [{ 'color': [] }, { 'background': [] }],
                    ['link', 'clean']
                ]
            }
        });

        // Set initial HTML content
        quillInstance.root.innerHTML = props.modelValue || '';

        // Listen for changes
        quillInstance.on('text-change', () => {
            const html = quillInstance.root.innerHTML;
            // Avoid infinite loops by only updating if value differs
            if (html !== props.modelValue) {
                emit('update:modelValue', html === '<p><br></p>' ? '' : html);
            }
        });

    } catch (err) {
        console.error('Failed to load Quill editor from CDN', err);
    }
});

// Watch for external changes to modelValue
watch(() => props.modelValue, (newVal) => {
    if (quillInstance && newVal !== quillInstance.root.innerHTML) {
        quillInstance.root.innerHTML = newVal || '';
    }
});
</script>

<template>
    <div class="rich-text-editor-wrapper border border-gray-200 rounded-2xl overflow-hidden bg-white shadow-sm hover:shadow-md transition-shadow">
        <div ref="editorContainer" class="min-h-[220px] max-h-[400px] overflow-y-auto"></div>
    </div>
</template>

<style>
/* Premium overrides to customize Quill toolbar and borders */
.rich-text-editor-wrapper .ql-toolbar.ql-snow {
    border: none !important;
    border-bottom: 1px solid #F3F4F6 !important;
    background-color: #F9FAFB !important;
    padding: 12px !important;
}

.rich-text-editor-wrapper .ql-container.ql-snow {
    border: none !important;
    font-family: inherit !important;
    font-size: 15px !important;
    color: #1F2937 !important;
}

.rich-text-editor-wrapper .ql-editor {
    padding: 18px !important;
    line-height: 1.7 !important;
    min-height: 200px !important;
}

.rich-text-editor-wrapper .ql-editor.ql-blank::before {
    font-style: normal !important;
    color: #9CA3AF !important;
    left: 18px !important;
}

/* Custom focus ring styling for the editor container */
.rich-text-editor-wrapper:focus-within {
    border-color: #EDAF11 !important;
    box-shadow: 0 0 0 3px rgba(237, 175, 17, 0.15) !important;
}
</style>
