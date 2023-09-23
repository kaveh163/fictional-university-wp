wp.blocks.registerBlockType("ourblocktheme/singlecampus", {
    title: "Fictional University Single Campus",
    edit: function () {
      const blockProps = wp.blockEditor.useBlockProps({className: "our-placeholder-block"});
      return wp.element.createElement("div", { ...blockProps }, "Single Campus Placeholder")
    },
    save: function () {
      return null
    }
  })
  