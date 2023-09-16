import {
  InnerBlocks,
  useBlockProps,
  useInnerBlocksProps,
} from "@wordpress/block-editor";
// first argument: namespace for all our blocks, and name for our specific block

wp.blocks.registerBlockType("ourblocktheme/slideshow", {
  apiVersion: 2,
  title: "Slideshow",
  supports: {
    align: ["full"],
  },
  attributes: {
    align: {
      type: "string",
      default: "full",
    },
  },

  edit: EditComponent,
  save: SaveComponent,
});
function EditComponent() {
  const blockProps = useBlockProps();
  return (
    <div {...blockProps}>
      <div style={{ backgroundColor: "#333", padding: "35px" }}>
        <p style={{ textAlign: "center", fontSize: "20px", color: "#FFF" }}>
          Slideshow
        </p>
        <InnerBlocks allowedBlocks={["ourblocktheme/slide"]} />
      </div>
    </div>
  );
}
function SaveComponent() {
    const blockProps = useBlockProps.save();
  return <InnerBlocks.Content {...blockProps}/>;
}
