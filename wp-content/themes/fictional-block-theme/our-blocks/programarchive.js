wp.blocks.registerBlockType("ourblocktheme/programarchive", {
    apiVersion: 2,
    title: "Fictional University Program Archive",
  
    edit: function () {
      const blockProps = wp.blockEditor.useBlockProps({className: "our-placeholder-block"});
      //second argument of createElement is an object of props. for example className
      return wp.element.createElement(
        "div",
        { ...blockProps },
        "Program Archive Placeholder"
      );
    },
    save: function () {
      return null;
    },
  });
  