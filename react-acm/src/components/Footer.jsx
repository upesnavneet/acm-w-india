import React from 'react';
import { mockThemeMod } from '../data/mockThemeMod';

export default function Footer({ onNavigate }) {
  const { footerLogo } = mockThemeMod;

  // Custom inline SVG icons matching the exact set of 8 soft-cyan (#80cee3) icons in parts/footer.html
  const socialIcons = [
    {
      name: 'facebook',
      url: 'https://www.facebook.com/AssociationForComputingMachinery/',
      svg: (
        <svg width="37" height="37" enableBackground="new 0 0 430.113 430.114" version="1.1" viewBox="0 0 430.11 430.11" xmlSpace="preserve" xmlns="http://www.w3.org/2000/svg">
          <path d="m158.08 83.3v59.218h-43.385v72.412h43.385v215.18h89.122v-215.18h59.805s5.601-34.721 8.316-72.685h-67.784s0-42.127 0-49.511c0-7.4 9.717-17.354 19.321-17.354h48.557v-75.385h-66.021c-93.519-5e-3 -91.316 72.479-91.316 83.299z" fill="#80cee3"/>
        </svg>
      )
    },
    {
      name: 'twitter',
      url: 'https://twitter.com/theofficialacm',
      svg: (
        <svg width="37" height="37" enableBackground="new 0 0 612 612" version="1.1" viewBox="0 0 612 612" xmlSpace="preserve" xmlns="http://www.w3.org/2000/svg">
          <path d="m612 116.26c-22.525 9.981-46.694 16.75-72.088 19.772 25.929-15.527 45.777-40.155 55.184-69.411-24.322 14.379-51.169 24.82-79.775 30.48-22.907-24.437-55.49-39.658-91.63-39.658-69.334 0-125.55 56.217-125.55 125.51 0 9.828 1.109 19.427 3.251 28.606-104.33-5.24-196.84-55.223-258.75-131.17-10.823 18.51-16.98 40.078-16.98 63.101 0 43.559 22.181 81.993 55.835 104.48-20.575-0.688-39.926-6.348-56.867-15.756v1.568c0 60.806 43.291 111.55 100.69 123.1-10.517 2.83-21.607 4.398-33.08 4.398-8.107 0-15.947-0.803-23.634-2.333 15.985 49.907 62.336 86.199 117.25 87.194-42.947 33.654-97.099 53.655-155.92 53.655-10.134 0-20.116-0.612-29.944-1.721 55.567 35.681 121.54 56.485 192.44 56.485 230.95 0 357.19-191.29 357.19-357.19l-0.421-16.253c24.666-17.593 46.005-39.697 62.794-64.861z" fill="#80cee3"/>
        </svg>
      )
    },
    {
      name: 'linkedin',
      url: 'https://www.linkedin.com/company/association-for-computing-machinery',
      svg: (
        <svg width="37" height="37" enableBackground="new 0 0 430.117 430.117" version="1.1" viewBox="0 0 430.12 430.12" xmlSpace="preserve" xmlns="http://www.w3.org/2000/svg">
          <path d="m430.12 261.54v159.02h-92.188v-148.37c0-37.271-13.334-62.707-46.703-62.707-25.473 0-40.632 17.142-47.301 33.724-2.432 5.928-3.058 14.179-3.058 22.477v154.87h-92.219s1.242-251.28 0-277.32h92.21v39.309c-0.187 0.294-0.43 0.611-0.606 0.896h0.606v-0.896c12.251-18.869 34.13-45.824 83.102-45.824 60.673-1e-3 106.16 39.636 106.16 124.82zm-377.93-251.98c-31.548 0-52.183 20.693-52.183 47.905 0 26.619 20.038 47.94 50.959 47.94h0.616c32.159 0 52.159-21.317 52.159-47.94-0.606-27.212-20-47.905-51.551-47.905zm-46.706 411h92.184v-277.32h-92.184v277.32z" fill="#80cee3"/>
        </svg>
      )
    },
    {
      name: 'reddit',
      url: 'https://www.reddit.com/r/acm/',
      svg: (
        <svg xmlns="http://www.w3.org/2000/svg" fill="#80cee3" width="37" height="37" viewBox="0 0 24 24">
          <path d="M14.238 15.348c.085.084.085.221 0 .306-.465.462-1.194.687-2.231.687l-.008-.002-.008.002c-1.036 0-1.766-.225-2.231-.688-.085-.084-.085-.221 0-.305.084-.084.222-.084.307 0 .379.377 1.008.561 1.924.561l.008.002.008-.002c.915 0 1.544-.184 1.924-.561.085-.084.223-.084.307 0zm-3.44-2.418c0-.507-.414-.919-.922-.919-.509 0-.923.412-.923.919 0 .506.414.918.923.918.508.001.922-.411.922-.918zm13.202-.93c0 6.627-5.373 12-12 12s-12-5.373-12-12 5.373-12 12-12 12 5.373 12 12zm-5-.129c0-.851-.695-1.543-1.55-1.543-.417 0-.795.167-1.074.435-1.056-.695-2.485-1.137-4.066-1.194l.865-2.724 2.343.549-.003.034c0 .696.569 1.262 1.268 1.262.699 0 1.267-.566 1.267-1.262s-.568-1.262-1.267-1.262c-.537 0-.994.335-1.179.804l-2.525-.592c-.11-.027-.223.037-.257.145l-.965 3.038c-1.656.02-3.155.466-4.258 1.181-.277-.255-.644-.415-1.05-.415-.854.001-1.549.693-1.549 1.544 0 .566.311 1.056.768 1.325-.03.164-.05.331-.05.5 0 2.281 2.805 4.137 6.253 4.137s6.253-1.856 6.253-4.137c0-.16-.017-.317-.044-.472.486-.261.82-.766.82-1.353zm-4.872.141c-.509 0-.922.412-.922.919 0 .506.414.918.922.918s.922-.412.922-.918c0-.507-.413-.919-.922-.919z" />
        </svg>
      )
    },
    {
      name: 'youtube',
      url: 'https://www.youtube.com/user/TheOfficialACM',
      svg: (
        <svg width="37" height="37" enableBackground="new 0 0 90 90" version="1.1" viewBox="0 0 90 90" xmlSpace="preserve" xmlns="http://www.w3.org/2000/svg">
          <path d="m70.939 65.832h-4.939l0.023-2.869c0-1.275 1.047-2.318 2.326-2.318h0.315c1.282 0 2.332 1.043 2.332 2.318l-0.057 2.869zm-18.526-6.148c-1.253 0-2.278 0.842-2.278 1.873v13.953c0 1.029 1.025 1.869 2.278 1.869 1.258 0 2.284-0.84 2.284-1.869v-13.953c0-1.032-1.026-1.873-2.284-1.873zm30.087-7.805v26.544c0 6.367-5.521 11.577-12.27 11.577h-50.459c-6.751 0-12.271-5.21-12.271-11.577v-26.544c0-6.367 5.52-11.578 12.271-11.578h50.459c6.749 0 12.27 5.211 12.27 11.578zm-59.363 29.426-4e-3 -27.961 6.255 2e-3v-4.143l-16.674-0.025v4.073l5.205 0.015v28.039h5.218zm18.75-23.796h-5.215v14.931c0 2.16 0.131 3.24-8e-3 3.621-0.424 1.158-2.33 2.388-3.073 0.125-0.126-0.396-0.015-1.591-0.017-3.643l-0.021-15.034h-5.186l0.016 14.798c4e-3 2.268-0.051 3.959 0.018 4.729 0.127 1.357 0.082 2.939 1.341 3.843 2.346 1.69 6.843-0.252 7.968-2.668l-0.01 3.083 4.188 5e-3 -1e-3 -23.79zm16.683 17.098-0.011-12.427c-4e-3 -4.736-3.547-7.572-8.356-3.74l0.021-9.239-5.209 8e-3 -0.025 31.89 4.284-0.062 0.39-1.986c5.473 5.021 8.914 1.58 8.906-4.444zm16.321-1.647-3.91 0.021c-2e-3 0.155-8e-3 0.334-0.01 0.529v2.182c0 1.168-0.965 2.119-2.137 2.119h-0.766c-1.174 0-2.139-0.951-2.139-2.119v-5.739h8.954v-3.37c0-2.463-0.063-4.925-0.267-6.333-0.641-4.454-6.893-5.161-10.051-2.881-0.991 0.712-1.748 1.665-2.188 2.945-0.444 1.281-0.665 3.031-0.665 5.254v7.41c2e-3 12.318 14.964 10.577 13.179-0.018zm-20.058-40.228c0.269 0.654 0.687 1.184 1.254 1.584 0.56 0.394 1.276 0.592 2.134 0.592 0.752 0 1.418-0.203 1.998-0.622 0.578-0.417 1.065-1.04 1.463-1.871l-0.099 2.046h5.813v-24.721h-4.576v19.24c0 1.042-0.858 1.895-1.907 1.895-1.043 0-1.904-0.853-1.904-1.895v-19.24h-4.776v16.674c0 2.124 0.039 3.54 0.102 4.258 0.065 0.713 0.229 1.397 0.498 2.06zm-17.616-13.962c0-2.373 0.198-4.226 0.591-5.562 0.396-1.331 1.107-2.401 2.137-3.208 1.027-0.811 2.342-1.217 3.941-1.217 1.345 0 2.497 0.264 3.459 0.781 0.967 0.52 1.713 1.195 2.23 2.028 0.527 0.836 0.885 1.695 1.076 2.574 0.195 0.891 0.291 2.235 0.291 4.048v6.252c0 2.293-0.092 3.98-0.271 5.051-0.177 1.074-0.557 2.07-1.146 3.004-0.58 0.924-1.329 1.615-2.237 2.056-0.918 0.445-1.968 0.663-3.154 0.663-1.325 0-2.441-0.183-3.361-0.565-0.923-0.38-1.636-0.953-2.144-1.714-0.513-0.762-0.874-1.69-1.092-2.772-0.219-1.081-0.323-2.707-0.323-4.874l3e-3 -6.545zm4.553 9.82c0 1.4 1.042 2.543 2.311 2.543 1.27 0 2.308-1.143 2.308-2.543v-13.16c0-1.398-1.038-2.541-2.308-2.541-1.269 0-2.311 1.143-2.311 2.541v13.16zm-16.088 6.645h5.484l6e-3 -18.96 6.48-16.242h-5.998l-3.445 12.064-3.494-12.097h-5.936l6.894 16.284 9e-3 18.951z" fill="#80cee3"/>
        </svg>
      )
    },
    {
      name: 'instagram',
      url: 'https://www.instagram.com/theofficialacm/',
      svg: (
        <svg width="37" height="37" enableBackground="new 0 0 169.063 169.063" version="1.1" viewBox="0 0 169.06 169.06" xmlSpace="preserve" xmlns="http://www.w3.org/2000/svg">
          <g fill="#80cee3">
            <path d="M122.406,0H46.654C20.929,0,0,20.93,0,46.655v75.752c0,25.726,20.929,46.655,46.654,46.655h75.752   c25.727,0,46.656-20.93,46.656-46.655V46.655C169.063,20.93,148.133,0,122.406,0z M154.063,122.407   c0,17.455-14.201,31.655-31.656,31.655H46.654C29.2,154.063,15,139.862,15,122.407V46.655C15,29.201,29.2,15,46.654,15h75.752   c17.455,0,31.656,14.201,31.656,31.655V122.407z"/>
            <path d="m84.531 40.97c-24.021 0-43.563 19.542-43.563 43.563 0 24.02 19.542 43.561 43.563 43.561s43.563-19.541 43.563-43.561c0-24.021-19.542-43.563-43.563-43.563zm0 72.123c-15.749 0-28.563-12.812-28.563-28.561 0-15.75 12.813-28.563 28.563-28.563s28.563 12.813 28.563 28.563c0 15.749-12.814 28.561-28.563 28.561z"/>
            <path d="m129.92 28.251c-2.89 0-5.729 1.17-7.77 3.22-2.051 2.04-3.23 4.88-3.23 7.78 0 2.891 1.18 5.73 3.23 7.78 2.04 2.04 4.88 3.22 7.77 3.22 2.9 0 5.73-1.18 7.78-3.22 2.05-2.05 3.22-4.89 3.22-7.78 0-2.9-1.17-5.74-3.22-7.78-2.04-2.05-4.88-3.22-7.78-3.22z"/>
          </g>
        </svg>
      )
    },
    {
      name: 'flickr',
      url: 'https://www.flickr.com/photos/theofficialacm',
      svg: (
        <svg width="37" height="37" enableBackground="new 0 0 90 90" version="1.1" viewBox="0 0 90 90" xmlSpace="preserve" xmlns="http://www.w3.org/2000/svg">
          <path d="M90,45.004C90,56.047,80.973,65,69.83,65c-11.139,0-20.169-8.953-20.169-19.996   C49.661,33.955,58.691,25,69.83,25C80.973,25,90,33.955,90,45.004z M20.169,25C9.03,25,0,33.955,0,45.004   C0,56.047,9.03,65,20.169,65s20.169-8.953,20.169-19.996C40.338,33.955,31.308,25,20.169,25z" fill="#80cee3"/>
        </svg>
      )
    },
    {
      name: 'mastodon',
      url: 'https://mastodon.social/@acm',
      svg: (
        <svg fill="#80cee3" width="37" height="37" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" xmlSpace="preserve">
          <path d="M21.327 8.566c0-4.339-2.843-5.61-2.843-5.61-1.433-.658-3.894-.935-6.451-.956h-.063c-2.557.021-5.016.298-6.45.956 0 0-2.843 1.272-2.843 5.61 0 .993-.019 2.181.012 3.441.103 4.243.778 8.425 4.701 9.463 1.809.479 3.362.579 4.612.51 2.268-.126 3.541-.809 3.541-.809l-.075-1.646s-1.621.511-3.441.449c-1.804-.062-3.707-.194-3.999-2.409a4.523 4.523 0 0 1-.04-.621s1.77.433 4.014.536c1.372.063 2.658-.08 3.965-.236 2.506-.299 4.688-1.843 4.962-3.254.434-2.223.398-5.424.398-5.424zm-3.353 5.59h-2.081V9.057c0-1.075-.452-1.62-1.357-1.62-1 0-1.501.647-1.501 1.927v2.791h-2.069V9.364c0-1.28-.501-1.927-1.502-1.927-.905 0-1.357.546-1.357 1.62v5.099H6.026V8.903c0-1.074.273-1.927.823-2.558.566-.631 1.307-.955 2.228-.955 1.065 0 1.872.409 2.405 1.228l.518.869.519-.869c.533-.819 1.34-1.228 2.405-1.228.92 0 1.662.324 2.228.955.549.631.822 1.484.822 2.558v5.253z"/>
        </svg>
      )
    }
  ];

  return (
    <div style={{ clear: 'both', width: '100%', background: '#e9e9e9' }}>
      <div className="row" style={{ maxWidth: '1176px', margin: '0 auto', boxSizing: 'border-box' }}>
        <footer style={{ 
          background: '#282828',
          borderTop: '8px solid #a6bc09',
          padding: '40px 20px 40px 20px', 
          color: '#b7b7b7', 
          boxSizing: 'border-box',
          fontFamily: 'Verdana, Geneva, Tahoma, sans-serif',
          display: 'flex',
          flexWrap: 'wrap',
          justifyContent: 'space-between'
        }}>
          
          {/* Left Column: ACM logo branding & Social Icons Grid */}
          <div className="logo_social_group" style={{ width: '270px', marginBottom: '20px' }}>
            {footerLogo && (
              <img 
                alt="ACM Logo" 
                width="200" 
                height="70" 
                className="img-responsive" 
                src={footerLogo} 
                style={{ 
                  display: 'block', 
                  height: '64px', 
                  width: '200px', 
                  objectFit: 'contain', 
                  marginBottom: '15px' 
                }}
              />
            )}

            {/* Social grid representing 4x2 layout exactly like the screenshot */}
            <ul className="footer__social" style={{ 
              display: 'grid', 
              gridTemplateColumns: 'repeat(4, 37px)', 
              gap: '15px 12px', 
              listStyle: 'none', 
              padding: 0, 
              margin: '20px 0 0 0' 
            }}>
              {socialIcons.map((social) => (
                <li key={social.name} style={{ padding: 0, margin: 0, height: '37px', width: '37px' }}>
                  <a 
                    href={social.url} 
                    target="_blank" 
                    rel="noreferrer" 
                    title={`Follow us on ${social.name}`}
                    style={{
                      display: 'flex',
                      alignItems: 'center',
                      justifyContent: 'center',
                      width: '37px',
                      height: '37px',
                      transition: 'transform 0.15s ease-in-out',
                    }}
                    onMouseEnter={(e) => { e.currentTarget.style.transform = 'scale(1.15)'; }}
                    onMouseLeave={(e) => { e.currentTarget.style.transform = 'scale(1)'; }}
                  >
                    {social.svg}
                  </a>
                </li>
              ))}
            </ul>
          </div>

          {/* Right Column: Footer Widgets (Categories & Archives) with column-count style */}
          <nav style={{ 
            width: 'calc(100% - 290px)', 
            minWidth: '300px'
          }}>
            <div className="footer-nav" style={{ 
              display: 'grid',
              gridTemplateColumns: 'repeat(3, 1fr)',
              gap: '20px', 
              padding: '10px 0'
            }}>
              
              {/* Widget 1: Categories */}
              <div className="widget">
                <h3 className="widgettitle" style={{ 
                  color: '#fff', 
                  fontSize: '18px', 
                  margin: '0 0 15px 0', 
                  fontWeight: 'normal', 
                  fontFamily: 'Verdana, Geneva, Tahoma, sans-serif'
                }}>
                  Categories
                </h3>
                <ul style={{ listStyle: 'none', padding: 0, margin: 0, paddingLeft: '10px' }}>
                  <li style={{ fontSize: '15px', margin: '5px 0' }}>
                    <a 
                      href="#home" 
                      onClick={(e) => { e.preventDefault(); onNavigate('home'); }} 
                      style={{ color: '#b7b7b7', textDecoration: 'none', transition: 'color 0.2s', fontFamily: 'Verdana, Geneva, Tahoma, sans-serif' }}
                      onMouseEnter={(e) => { e.currentTarget.style.color = '#1599cc'; }}
                      onMouseLeave={(e) => { e.currentTarget.style.color = '#b7b7b7'; }}
                    >
                      Uncategorized
                    </a>
                  </li>
                </ul>
              </div>

              {/* Widget 2: Archives */}
              <div className="widget">
                <h3 className="widgettitle" style={{ 
                  color: '#fff', 
                  fontSize: '18px', 
                  margin: '0 0 15px 0', 
                  fontWeight: 'normal', 
                  fontFamily: 'Verdana, Geneva, Tahoma, sans-serif'
                }}>
                  Archives
                </h3>
                <ul style={{ listStyle: 'none', padding: 0, margin: 0, paddingLeft: '10px' }}>
                  <li style={{ fontSize: '15px', margin: '5px 0' }}>
                    <a 
                      href="#home" 
                      onClick={(e) => { e.preventDefault(); onNavigate('home'); }} 
                      style={{ color: '#b7b7b7', textDecoration: 'none', transition: 'color 0.2s', fontFamily: 'Verdana, Geneva, Tahoma, sans-serif' }}
                      onMouseEnter={(e) => { e.currentTarget.style.color = '#1599cc'; }}
                      onMouseLeave={(e) => { e.currentTarget.style.color = '#b7b7b7'; }}
                    >
                      May 2026
                    </a>
                  </li>
                </ul>
              </div>

              {/* Empty Column for matching column count of 3 */}
              <div></div>

            </div>
          </nav>

        </footer>

        {/* Bottom Bar Credits (replicates footer-bottom-menu & footer__legal) */}
        <div className="footer-bottom-menu" style={{ 
          backgroundColor: '#333', 
          color: '#b7b7b7', 
          fontSize: '11px', 
          padding: '15px 20px',
          display: 'flex',
          justifyContent: 'space-between',
          alignItems: 'center',
          boxSizing: 'border-box',
          width: '100%',
          fontFamily: 'Verdana, Geneva, Tahoma, sans-serif'
        }}>
          <ul style={{ display: 'flex', listStyle: 'none', padding: 0, margin: 0 }}>
            <li style={{ padding: 0, margin: 0, lineHeight: 1 }}>
              <a 
                href="#/" 
                onClick={(e) => { e.preventDefault(); }} 
                style={{ color: '#b7b7b7', textDecoration: 'underline', transition: 'color 0.2s' }}
                onMouseEnter={(e) => { e.currentTarget.style.color = '#1599cc'; }}
                onMouseLeave={(e) => { e.currentTarget.style.color = '#b7b7b7'; }}
              >
                Sample Page
              </a>
            </li>
          </ul>
          <div className="footer__copyright" style={{ color: '#b7b7b7', margin: 0, lineHeight: 1 }}>
            2023, ACM
          </div>
        </div>
      </div>
    </div>
  );
}
