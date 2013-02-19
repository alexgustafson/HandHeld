//
//  CMContentView.m
//  ZHAW HandHeld
//
//  Created by Alex Gustafson on 2/18/13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import "CMContentView.h"

@interface CMContentView ()

@end

@implementation CMContentView
@synthesize mainScrollView, dbManager, article, mainImage, mainImageView, htmlText;

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
    }
    return self;
}

- (void)initializeWithArticle:(HHArticleModel *)a andHHManager:(SqLiteDatabaseManager*)db
{
    [self setArticle:a];
    [self setDbManager:db];
    
    NSDictionary* structuredData = [[self dbManager] parseArticleData:[[self article] data]];
    
    for (id fieldID in structuredData) {
        
        HHFieldModel* field = [structuredData objectForKey:fieldID];
        
        if ([field.fieldTypeName isEqualToString:@"resource_path"]) {
            
            if ([field.name isEqualToString:@"Main Image"]) {
                
                self.mainImage = field.getImageForResource;
                
            }
            
        }else if ([field.fieldTypeName isEqualToString:@"url"])
        {
            if ([field.name isEqualToString:@"Image Source URL"]) {
                
            }
        }else if ([field.fieldTypeName isEqualToString:@"text"])
        {
            if ([field.name isEqualToString:@"Title"]) {
                [self setTitle:field.data];
            }
        }else if ([field.fieldTypeName isEqualToString:@"html_text"])
        {
            if ([field.name isEqualToString:@"Computer Info Text"]) {
                
                htmlString = [NSString stringWithFormat:@"<html><body> %@ </body></html>", field.data];
                
                [htmlText loadHTMLString:htmlString baseURL:nil];
                
            }
        }
    }
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    // Do any additional setup after loading the view from its nib.
    
    [[self mainImageView] setImage:mainImage];
    [htmlText setBackgroundColor:[UIColor clearColor]];
    [htmlText setOpaque:NO];
    [htmlText loadHTMLString:htmlString baseURL:nil];
    
    [mainScrollView setContentSize:CGSizeMake(self.view.frame.size.width, mainImageView.frame.size.height + htmlText.frame.size.height + 50)];
    
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

@end
