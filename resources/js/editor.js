
import { Editor } from '@tiptap/core';
import StarterKit from '@tiptap/starter-kit';
import Link from '@tiptap/extension-link';
import Image from '@tiptap/extension-image';
import Underline from '@tiptap/extension-underline';
import Placeholder from '@tiptap/extension-placeholder';

window.setupEditor = function (content, options = {}) {
    return {
        editor: null,
        content: content,
        updatedAt: Date.now(),

        init() {
            this.editor = new Editor({
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
                            class: 'rounded-lg max-w-full h-auto',
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
                        class: 'prose prose-sm sm:prose lg:prose-lg xl:prose-2xl mx-auto focus:outline-none min-h-[150px] px-6 py-4',
                    },
                },
            });
        },

        isActive(type, opts = {}) {
            return this.editor ? this.editor.isActive(type, opts) : false;
        },
        toggleBold() { this.editor.chain().focus().toggleBold().run(); },
        toggleItalic() { this.editor.chain().focus().toggleItalic().run(); },
        toggleUnderline() { this.editor.chain().focus().toggleUnderline().run(); },
        toggleHeading(level) { this.editor.chain().focus().toggleHeading({ level }).run(); },
        toggleBulletList() { this.editor.chain().focus().toggleBulletList().run(); },
        toggleOrderedList() { this.editor.chain().focus().toggleOrderedList().run(); },
        undo() { this.editor.chain().focus().undo().run(); },
        redo() { this.editor.chain().focus().redo().run(); },

        setLink() {
            const previousUrl = this.editor.getAttributes('link').href;
            const url = window.prompt('URL', previousUrl);
            if (url === null) return;
            if (url === '') {
                this.editor.chain().focus().extendMarkRange('link').unsetLink().run();
                return;
            }
            this.editor.chain().focus().extendMarkRange('link').setLink({ href: url }).run();
        },

        addImage() {
            const url = window.prompt('Image URL');
            if (url) {
                this.editor.chain().focus().setImage({ src: url }).run();
            }
        }
    }
};
