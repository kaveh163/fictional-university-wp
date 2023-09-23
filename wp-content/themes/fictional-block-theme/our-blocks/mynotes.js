wp.blocks.registerBlockType("ourblocktheme/mynotes", {
    apiVersion: 2,
    title: "Fictional University My Notes",
  
    edit: function () {
      const blockProps = wp.blockEditor.useBlockProps({className: "our-placeholder-block"});
      //second argument of createElement is an object of props. for example className
      return wp.element.createElement(
        "div",
        { ...blockProps},
        "My Notes Placeholder"
      );
    },
    save: function () {
      return null;
    },
  });
  