wp.blocks.registerBlockType("ourblocktheme/pastevents", {
    title: "Fictional University Past Events",
    edit: function () {
      const blockProps = wp.blockEditor.useBlockProps({className: "our-placeholder-block"});
      return wp.element.createElement("div", { ...blockProps }, "Past Events Placeholder")
    },
    save: function () {
      return null
    }
  })
  