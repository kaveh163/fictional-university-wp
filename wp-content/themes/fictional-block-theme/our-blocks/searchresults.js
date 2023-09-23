wp.blocks.registerBlockType("ourblocktheme/searchresults", {
    title: "Fictional University Searc Results",
    edit: function () {
      const blockProps = wp.blockEditor.useBlockProps({className: "our-placeholder-block"});
      return wp.element.createElement("div", { ...blockProps }, "Search Results Placeholder")
    },
    save: function () {
      return null
    }
  })
  