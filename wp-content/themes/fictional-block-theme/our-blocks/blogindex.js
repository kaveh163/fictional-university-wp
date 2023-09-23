wp.blocks.registerBlockType("ourblocktheme/blogindex", {
    apiVersion: 2,
    title: "Fictional University Blog Index",
  
    edit: function () {
      const blockProps = wp.blockEditor.useBlockProps({className: "our-placeholder-block"});
      //second argument of createElement is an object of props. for example className
      return wp.element.createElement(
        "div",
        { ...blockProps },
        "Blog Index Placeholder"
      );
    },
    save: function () {
      return null;
    },
  });
  