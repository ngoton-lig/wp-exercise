wp.domReady(() => {
    // 引用（デフォルト）
    wp.blocks.unregisterBlockStyle('core/quote', 'default');

    // 引用（大）
    wp.blocks.unregisterBlockStyle('core/quote', 'large');

    // 画像（デフォルト）
    wp.blocks.unregisterBlockStyle('core/image', 'default');

    // 画像（角丸）
    wp.blocks.unregisterBlockStyle('core/image', 'rounded');

    // プルクオート（デフォルト）
    wp.blocks.unregisterBlockStyle('core/pullquote', 'default');

    // プルクオート（単色）
    wp.blocks.unregisterBlockStyle('core/pullquote', 'solid-color');

    // 表（デフォルト）
    wp.blocks.unregisterBlockStyle('core/table', 'regular');

    // 表（ストライプ）
    wp.blocks.unregisterBlockStyle('core/table', 'stripes');

    // ボタン（デフォルト）
    wp.blocks.unregisterBlockStyle('core/button', 'fill');

    // ボタン（ストライプ）
    wp.blocks.unregisterBlockStyle('core/button', 'outline');

    // 区切り（デフォルト）
    wp.blocks.unregisterBlockStyle('core/separator', 'default');

    // 区切り（幅広線）
    wp.blocks.unregisterBlockStyle('core/separator', 'wide');

    // 区切り（ドット）
    wp.blocks.unregisterBlockStyle('core/separator', 'dots');

    if (document.body.classList.contains('block-editor-page')) {
        document.body.addEventListener('click', addBodyClass);
    }

    addBodyClass();

    function addBodyClass() {
        let selectedBlock = wp.data.select('core/block-editor').getSelectedBlock();

        if (selectedBlock && selectedBlock.name === 'core/heading') {
            document.body.classList.add('is-heading');
        } else if (selectedBlock && selectedBlock.name !== 'core/heading') {
            document.body.classList.remove('is-heading');
        }

        if (selectedBlock && selectedBlock.name === 'core/paragraph') {
            document.body.classList.add('is-paragraph');
        } else if (selectedBlock && selectedBlock.name !== 'core/paragraph') {
            document.body.classList.remove('is-paragraph');
        }

        if (selectedBlock && selectedBlock.name === 'core/button') {
            document.body.classList.add('is-button');
        } else if (selectedBlock && selectedBlock.name !== 'core/button') {
            document.body.classList.remove('is-button');
        }

        if (selectedBlock && selectedBlock.name === 'core/file') {
            document.body.classList.add('is-file');
        } else if (selectedBlock && selectedBlock.name !== 'core/file') {
            document.body.classList.remove('is-file');
        }

        if (selectedBlock && selectedBlock.name === 'core/table') {
            document.body.classList.add('is-table');
        } else if (selectedBlock && selectedBlock.name !== 'core/table') {
            document.body.classList.remove('is-table');
        }
    }
});