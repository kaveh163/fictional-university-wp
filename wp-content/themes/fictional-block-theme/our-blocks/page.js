wp.blocks.registerBlockType("ourblocktheme/page", {
    apiVersion: 2,
    title: "Fictional University Page",
  
    edit: function () {
      const blockProps = wp.blockEditor.useBlockProps({className: "our-placeholder-block"});
      //second argument of createElement is an object of props. for example className
      return wp.element.createElement(
        "div",
        { ...blockProps },
        "Single Page Placeholder"
      );
    },
    save: function () {
      return null;
    },
  });
  