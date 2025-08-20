
const { permalink_structure, category_base, tag_base } = __VUE_WORDPRESS__.routing

const tagToParam = {
  author: ':author',
  postname: ':slug',
  post_id: ':id(\\d+)',
  category: ':cat1/:cat2?/:cat3?',
  year: ':year(\\d{4})',
  monthnum: ':month(\\d{2})',
  day: ':day(\\d{2})',
  hour: ':hour(\\d{2})',
  minute: ':min(\\d{2})',
  second: ':sec(\\d{2})'
}

// If no category/tag base set WP uses base of singlePost permalink structure excluding tags
const defaultTaxonomyBase = permalink_structure.slice(0, permalink_structure.indexOf('%'))
// Appended to route paths with pagination
const paginateParam = ':page(page\/\\d+)?'

export default {
  demo: `/demo/`,
  singleDemo: `/demo/:slug/`,
  single: permalink_structure.replace(/\%[a-z_]+\%/g, match => tagToParam[match.slice(1,-1)]).slice(0,-1),
  postsPage: (slug) => slug ? `/${slug}/${paginateParam}` : `/${paginateParam}`
}