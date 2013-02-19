//
//  CMTabBarController.m
//  ZHAW HandHeld
//
//  Created by Alex Gustafson on 2/18/13.
//  Copyright (c) 2013 Alexander Gustafson. All rights reserved.
//

#import "CMTabBarController.h"

@interface CMTabBarController ()

@end

@implementation CMTabBarController
@synthesize article, dbManager, tabBarItems;

- (id)initWithNibName:(NSString *)nibNameOrNil bundle:(NSBundle *)nibBundleOrNil
{
    self = [super initWithNibName:nibNameOrNil bundle:nibBundleOrNil];
    if (self) {
        // Custom initialization
        tabBarItems = [[NSMutableArray alloc] init];
    }
    return self;
}

- (void)initializeWithArticle:(HHArticleModel *)a andHHManager:(SqLiteDatabaseManager*)db
{
    [self setArticle:a];
    [self setDbManager:db];
    
    NSDictionary* structuredData = [[self dbManager] parseArticleData:[[self article] data]];
    NSMutableArray* tabBarData = [[NSArray alloc] init];
    
    NSMutableArray * sortedArray = [[NSMutableArray alloc] initWithCapacity:structuredData.count];

    NSSortDescriptor *valueDescriptor = [[[NSSortDescriptor alloc] initWithKey:@"order_nr" ascending:YES] autorelease];
    NSArray * descriptors = [NSArray arrayWithObject:valueDescriptor];
    
    
    for (id key in structuredData)
    {
        HHFieldModel *subfield = [structuredData objectForKey:key];
        [sortedArray addObject:subfield];
        
    }
    
    sortedArray = [sortedArray sortedArrayUsingDescriptors:descriptors];
        
    
    for (HHFieldModel *field in sortedArray) {
        
        if ([field.fieldTypeName isEqualToString:@"Tabbar Item"]) {
            
            UITabBarItem *tabBarItem = [[UITabBarItem alloc] init];
            
            for (id key in field.children) {
                
                HHFieldModel *subfield = [field.children objectForKey:key];
                
                if ([subfield.fieldTypeName isEqualToString:@"text"]) {
                    [tabBarItem setTitle:subfield.data];
                    
                }else if ([subfield.fieldTypeName isEqualToString:@"resource_path"])
                {
                    [tabBarItem setImage:subfield.getImageForResource];
                    
                }else if ([subfield.fieldTypeName isEqualToString:@"link_to_article"])
                {
                    [tabBarItem setTag:subfield.data];
                }
                
            }
            
            [tabBarItems addObject:tabBarItem];
            [tabBarItem autorelease];
        
            
        }else if ([field.fieldTypeName isEqualToString:@"text"])
        {
            if ([field.name isEqualToString:@"Title"])
            {
                self.title = field.data;
            }
            
        }else if ([field.fieldTypeName isEqualToString:@"link_to_article"])
        {
            if ([field.name isEqualToString:@"Start Item"])
            {
                
            }
        }
    }
}

- (void)viewDidLoad
{
    [super viewDidLoad];
    // Do any additional setup after loading the view from its nib.
    
    for (UITabBarItem* item in tabBarItems) {
        
    }
    
    
}

- (void)didReceiveMemoryWarning
{
    [super didReceiveMemoryWarning];
    // Dispose of any resources that can be recreated.
}

@end
