
import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Link from '@tiptap/extension-link';
import Image from '@tiptap/extension-image';
import Underline from '@tiptap/extension-underline';
import Placeholder from '@tiptap/extension-placeholder';

window.setupEditor = function (content, options = {}) {
    let editorInstance = null;

    return {
        content: content,
        updatedAt: Date.now(),

        init() {
            if (editorInstance) return;

            editorInstance = new Editor({
                element: this.$refs.editorElement,
                extensions: [
                    StarterKit,
                    Underline,
                    Link.configure({
                        openOnClick: false,
                        HTMLAttributes: {
                            class: 'text-emerald-500 hover:text-emerald-600 underline',
                        },
                    }),
                    Image.configure({
                        HTMLAttributes: {
                            class: 'rounded-lg max-w-full h-auto my-4',
                        },
                    }),
                    Placeholder.configure({
                        placeholder: options.placeholder || 'Write something...',
                    }),
                ],
                content: this.content,
                onUpdate: ({ editor }) => {
                    this.content = editor.getHTML();
                    this.$refs.input.value = this.content;
                    this.$dispatch('input', this.content);
                },
                onTransaction: () => {
                    this.updatedAt = Date.now();
                },
                onSelectionUpdate: () => {
                    this.updatedAt = Date.now();
                },
                editorProps: {
                    attributes: {
                        class: 'prose max-w-none w-full focus:outline-none min-h-[150px] px-6 py-4 text-gray-800',
                    },
                },
            });
        },

        isActive(type, opts = {}) {
            return editorInstance ? editorInstance.isActive(type, opts) : false;
        },
        toggleBold() { editorInstance && editorInstance.chain().focus().toggleBold().run(); },
        toggleItalic() { editorInstance && editorInstance.chain().focus().toggleItalic().run(); },
        toggleUnderline() { editorInstance && editorInstance.chain().focus().toggleUnderline().run(); },
        toggleHeading(level) { editorInstance && editorInstance.chain().focus().toggleHeading({ level }).run(); },
        toggleBulletList() { editorInstance && editorInstance.chain().focus().toggleBulletList().run(); },
        toggleOrderedList() { editorInstance && editorInstance.chain().focus().toggleOrderedList().run(); },
        undo() { editorInstance && editorInstance.chain().focus().undo().run(); },
        redo() { editorInstance && editorInstance.chain().focus().redo().run(); },

        setLink() {
            if (!editorInstance) return;
            const previousUrl = editorInstance.getAttributes('link').href;
            const url = window.prompt('URL', previousUrl);
            if (url === null) return;
            if (url === '') {
                editorInstance.chain().focus().extendMarkRange('link').unsetLink().run();
                return;
            }
            editorInstance.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
        },

        addImage() {
            if (!editorInstance) return;

            if (window.openMediaPicker) {
                window.openMediaPicker((media) => {
                    editorInstance.chain().focus().setImage({
                        src: media.url,
                        alt: media.alt_text,
                        title: media.original_filename
                    }).run();
                });
            } else {
                const url = window.prompt('Image URL');
                if (url) {
                    editorInstance.chain().focus().setImage({ src: url }).run();
                }
            }
        },

        destroy() {
            if (editorInstance) {
                editorInstance.destroy();
                editorInstance = null;
            }
        },

        // Clean up getter to check if editor exists (for disabled button states)
        get canUndo() {
            this.updatedAt;
            return editorInstance ? editorInstance.can().undo() : false;
        },
        get canRedo() {
            this.updatedAt;
            return editorInstance ? editorInstance.can().redo() : false;
        }
    }
};
