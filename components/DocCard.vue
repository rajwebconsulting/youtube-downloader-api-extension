<template>
  <div class="card max-w-6xl bg-base-100 shadow-xl mx-auto">
    <div class="card-body">
      <h2 class="card-title text-2xl">{{ title }}</h2>
      <div
        class="
          px-2
          py-4
          text-gray-900
          bg-blue-300
          border-2 border-blue-500
          rounded-md
          break-words
        "
      >
        <div class="badge text-white bg-blue-500 rounded-md border-0 px-4 py-4">
          GET
        </div>
        <span class="my-4">{{ ExampleUrl }}</span>
      </div>
      <h3>Parameters</h3>
      <span v-if="requireFtype">
        <div class="badge">FTYPE</div>
        <p>mp3 or mp4</p>
      </span>
      <div class="badge">{{paramName}}</div>
      <p v-if="isSearch">
        i.e. sia
      </p>
      <p v-else>
        any YouTube, SoundCloud, Facebook, Twitter, Instagram, TikTok, Vimeo,
        Dailymotion, VK, or AOL Video URL
      </p>
      <p class="text-center">iFrame Code:</p>
      <div class="mockup-code min-w-full">
        <pre><code>&lt;iframe id="{{iframeId}}" src="{{ PreUrl }}"</code></pre>
        <pre><code>width="100%" height="100%" allowtransparency="true" scrolling="no" style="border:none"&gt;&lt;/iframe&gt;</code></pre>
      </div>
      <div v-if="resizeJsCode">
        <JsResizerCode :frameId="iframeId" />
        <p class="text-center">Generates this:</p>
        <iframe
          v-resize="{ log: false, heightCalculationMethod: 'taggedElement'}"
          :id="iframeId"
          :src="PreUrl"
          width="100%"
          height="100%"
          allowtransparency="true"
          scrolling="no"
          style="border: none"
        ></iframe>
      </div>
      <div v-else>
        <p class="text-center">Generates this:</p>
        <iframe
          :id="iframeId"
          :src="PreUrl"
          width="100%"
          height="100%"
          allowtransparency="true"
          scrolling="no"
          style="border: none"
        ></iframe>
      </div>
    </div>
  </div>
</template>
<script>
import iframeResize from "iframe-resizer/js/iframeResizer";
export default {
  data() {
    return {};
  },
  props: {
    title: {
      type: String,
      default: () => {},
    },
    iframeId: {
      type: String,
    },
    ExampleUrl: {
      type: String,
    },
    PreUrl: {
      type: String,
    },
    requireFtype: {
      type: Boolean,
    },
    paramName: {
      type: String,
    },
    resizeJsCode: {
      type: Boolean,
    },
    isSearch: {
      type: Boolean,
    }
  },
  directives: {
    resize: {
      bind(el, { value = {} }) {
        el.addEventListener("load", () => iframeResize(value, el));
      },
    },
  },
};
</script>
