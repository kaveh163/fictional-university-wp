wp.blocks.registerBlockType("ourblocktheme/singleprogram", {
    apiVersion: 2,
    title: "Fictional University Single Program",
  
    edit: function () {
      const blockProps = wp.blockEditor.useBlockProps({className: "our-placeholder-block"});
      //second argument of createElement is an object of props. for example className
      return wp.element.createElement(
        "div",
        { ...blockProps },
        "Single Program Placeholder"
      );
    },
    save: function () {
      return null;
    },
  });
  