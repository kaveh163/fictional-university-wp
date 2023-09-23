wp.blocks.registerBlockType("ourblocktheme/archive", {
    title: "Fictional University Archive",
    edit: function () {
      const blockProps = wp.blockEditor.useBlockProps({className: "our-placeholder-block"});
      return wp.element.createElement("div", { ...blockProps }, "Archive Placeholder")
    },
    save: function () {
      return null
    }
  })
  