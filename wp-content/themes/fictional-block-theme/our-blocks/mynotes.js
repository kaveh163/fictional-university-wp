wp.blocks.registerBlockType("ourblocktheme/mynotes", {
    apiVersion: 2,
    title: "Fictional University My Notes",
  
    edit: function () {
      //second argument of createElement is an object of props. for example className
      return wp.element.createElement(
        "div",
        { className: "our-placeholder-block" },
        "My Notes Placeholder"
      );
    },
    save: function () {
      return null;
    },
  });
  