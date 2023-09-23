wp.blocks.registerBlockType("ourblocktheme/singleevent", {
    title: "Fictional University Single Event",
    edit: function () {
      const blockProps = wp.blockEditor.useBlockProps({className: "our-placeholder-block"});
      return wp.element.createElement("div", { ...blockProps }, "Single Event Placeholder")
    },
    save: function () {
      return null
    }
  })