wp.blocks.registerBlockType("ourblocktheme/archiveevent", {
    title: "Fictional University Event Archive",
    edit: function () {
      const blockProps = wp.blockEditor.useBlockProps({className: "our-placeholder-block"});
      return wp.element.createElement("div", { ...blockProps }, "Event Archive Placeholder")
    },
    save: function () {
      return null
    }
  })
  