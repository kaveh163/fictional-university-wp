wp.blocks.registerBlockType("ourblocktheme/archivecampus", {
    title: "Fictional University Campus Archive",
    edit: function () {
      const blockProps = wp.blockEditor.useBlockProps({className: "our-placeholder-block"});
      return wp.element.createElement("div", { ...blockProps }, "Campus Archive Placeholder")
    },
    save: function () {
      return null
    }
  })
  