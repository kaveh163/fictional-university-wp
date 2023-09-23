wp.blocks.registerBlockType("ourblocktheme/search", {
    title: "Fictional University Search",
    edit: function () {
      const blockProps = wp.blockEditor.useBlockProps({className: "our-placeholder-block"});
      return wp.element.createElement("div", { ...blockProps }, "Search Placeholder")
    },
    save: function () {
      return null
    }
  })
  